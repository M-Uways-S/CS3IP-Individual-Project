<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// DB credentials
$server = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "FYP";

// 1) Fetch all questions
$conn = new mysqli($server,$dbUser,$dbPass,$dbName);
if ($conn->connect_error) {
  die("DB Connection failed: " . $conn->connect_error);
}
$res = $conn->query("SELECT * FROM quiz_questions");
if (!$res || $res->num_rows === 0) {
  die("No questions found.");
}
$questions = $res->fetch_all(MYSQLI_ASSOC);
$conn->close();

// 2) Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // get answers safely
  $answers = $_POST['answers'] ?? [];
  if (!is_array($answers)) $answers = [];

  // grade
  $conn = new mysqli($server,$dbUser,$dbPass,$dbName);
  if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
  }
  $stmt = $conn->prepare("SELECT correct_option FROM quiz_questions WHERE id = ?");
  $correct = 0;
  foreach ($answers as $qid => $ans) {
    $stmt->bind_param("i", $qid);
    $stmt->execute();
    $stmt->bind_result($right);
    $stmt->fetch();
    if ($ans === $right) $correct++;
  }
  $stmt->close();

  // save score
  $stmt2 = $conn->prepare("UPDATE users SET score = ? WHERE username = ?");
  $stmt2->bind_param("is", $correct, $_SESSION['username']);
  $stmt2->execute();
  $stmt2->close();
  $conn->close();

  $total = count($questions);
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Your Results & Review</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <!-- Header -->
    <header class="site-header">
      <nav class="site-nav">
        <a href="home.php" class="logo">
          <img src="images/cookies-logo.png" class="logo-img" alt="Logo">
          Cookie Shield
        </a>
        <ul class="nav-main">
          <li><a href="home.php">Home</a></li>
          <li><a href="learn.php">Learn</a></li>
          <li><a href="quiz.php">Quiz</a></li>
          <li><a href="leaderboard.php">Leaderboard</a></li>
        </ul>
        <ul class="nav-auth">
          <li><span class="username">Hi, <?=htmlspecialchars($_SESSION['username'])?></span></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </header>

    <!-- Score Card -->
    <div class="result-container">
      <h2>Your Score</h2>
      <p class="score-value"><?= $correct ?> / <?= $total ?></p>
      <div class="btn-group">
        <a href="quiz.php" class="btn secondary">Try Again</a>
        <a href="leaderboard.php" class="btn primary">View Leaderboard</a>
        <button id="review-btn" class="btn secondary">Review Answers</button>
        <a href="home.php" class="btn primary">Back to Home</a>
      </div>
    </div>

    <!-- Review Answers (hidden until button click) -->
    <div id="review-container" class="review-container hidden">
      <h3>Review Your Answers</h3>
      <ul class="review-list">
        <?php foreach ($questions as $i => $q):
          $qid        = $q['id'];
          $userAns    = $answers[$qid] ?? '';
          $correctAns = $q['correct_option'];
          $opts       = [
            'A' => $q['option_a'],
            'B' => $q['option_b'],
            'C' => $q['option_c'],
            'D' => $q['option_d'],
          ];
          $isCorrect = ($userAns === $correctAns);
        ?>
        <li class="<?= $isCorrect ? 'correct' : 'wrong' ?>">
          <p><strong><?= ($i+1) ?>. <?= htmlspecialchars($q['question']) ?></strong></p>
          <p>Your answer: <?= htmlspecialchars($opts[$userAns] ?? 'No answer') ?></p>
          <?php if (!$isCorrect): ?>
            <p>Correct answer: <?= htmlspecialchars($opts[$correctAns]) ?></p>
          <?php endif; ?>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- Footer -->
    <footer>
      <p>&copy; 2025 MyWebsite. All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
    <script>
      // Show review when button clicked
      document.addEventListener("DOMContentLoaded", function() {
        const btn = document.getElementById("review-btn");
        if (!btn) return;
        btn.addEventListener("click", function() {
          document.getElementById("review-container")
                  .classList.remove("hidden");
          btn.style.display = "none";
          // scroll into view
          document.getElementById("review-container")
                  .scrollIntoView({behavior:"smooth"});
        });
      });
    </script>
  </body>
  </html>
  <?php
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Quiz</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <!-- Header same as above -->
  <header class="site-header">
    <nav class="site-nav">
      <a href="home.php" class="logo">
        <img src="images/cookies-logo.png" class="logo-img" alt="Logo">
        Cookie Shield
      </a>
      <ul class="nav-main">
        <li><a href="home.php">Home</a></li>
        <li><a href="learn.php">Learn</a></li>
        <li><a href="quiz.php" class="active">Quiz</a></li>
        <li><a href="leaderboard.php">Leaderboard</a></li>
      </ul>
      <ul class="nav-auth">
        <li><span class="username">Hi, <?=htmlspecialchars($_SESSION['username'])?></span></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <!-- Quiz Container -->
  <div class="quiz-container">
    <h1>Quiz</h1>

    <!-- Timer & Progress -->
    <div class="quiz-header">
      <div class="timer">Time Left: <span id="time">30</span>s</div>
      <div class="progress-text" id="progress-text">
        Question 1 of <?= count($questions) ?>
      </div>
      <div class="progress">
        <div id="progress-bar"></div>
      </div>
    </div>

    <form id="quiz-form" action="quiz.php" method="POST">
      <?php foreach ($questions as $i => $q): ?>
        <div class="slide <?= $i === 0 ? 'active' : '' ?>">
          <p class="question">
            <strong><?= ($i+1) ?>. <?= htmlspecialchars($q['question']) ?></strong>
          </p>
          <div class="options">
            <input type="radio" id="q<?= $q['id'] ?>A"
                  name="answers[<?= $q['id'] ?>]" value="A">
            <label for="q<?= $q['id'] ?>A"><?= htmlspecialchars($q['option_a']) ?></label>

            <input type="radio" id="q<?= $q['id'] ?>B"
                  name="answers[<?= $q['id'] ?>]" value="B">
            <label for="q<?= $q['id'] ?>B"><?= htmlspecialchars($q['option_b']) ?></label>

            <input type="radio" id="q<?= $q['id'] ?>C"
                  name="answers[<?= $q['id'] ?>]" value="C">
            <label for="q<?= $q['id'] ?>C"><?= htmlspecialchars($q['option_c']) ?></label>

            <input type="radio" id="q<?= $q['id'] ?>D"
                  name="answers[<?= $q['id'] ?>]" value="D">
            <label for="q<?= $q['id'] ?>D"><?= htmlspecialchars($q['option_d']) ?></label>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="nav-buttons">
        <button type="button" id="prev-btn" disabled>Previous</button>
        <button type="button" id="next-btn">Next</button>
      </div>
    </form>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 MyWebsite. All rights reserved.</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
