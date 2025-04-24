<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// (Optional) clear cookiesAccepted from localStorage
echo '<script>localStorage.removeItem("cookiesAccepted");</script>';

// Database connection
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "FYP";
$conn       = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch questions
$result = $conn->query("SELECT * FROM quiz_questions");
if (!$result || $result->num_rows === 0) {
    echo "No questions found!";
    exit();
}
$questions = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();

// Handle submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli($servername, $username, $password, $dbname);
    $stmt = $conn->prepare("SELECT correct_option FROM quiz_questions WHERE id = ?");
    $correct = 0;

    foreach ($_POST['answers'] as $qid => $ans) {
        $stmt->bind_param("i", $qid);
        $stmt->execute();
        $stmt->bind_result($right);
        $stmt->fetch();
        if ($ans === $right) {
            $correct++;
        }
    }
    $stmt->close();
    $conn->close();

    echo "<h2>Your Score: $correct / " . count($_POST['answers']) . "</h2>";
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

  <!-- your existing navbar (unchanged) -->
  <header class="site-header">
    <nav class="site-nav">
      <a href="home.php" class="logo">
        <img src="images/cookies-logo.png" alt="Cookies Logo" class="logo-img">
        Cookie Shield
      </a>
      <ul class="nav-main">
        <li><a href="home.php">Home</a></li>
        <li><a href="learn.php">Learn</a></li>
        <li><a href="quiz.php">Quiz</a></li>
      </ul>
      <ul class="nav-auth">
        <?php if (!empty($_SESSION['username'])): ?>
          <li><span class="username">Hi, <?=htmlspecialchars($_SESSION['username'])?></span></li>
          <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
          <li><a href="login.php">Login</a></li>
          <li><a href="signup.php">Sign Up</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>

  <!-- Quiz slides -->
  <div class="quiz-container">
    <h1>Quiz</h1>
    <form id="quiz-form" action="quiz.php" method="POST">
      <?php foreach ($questions as $i => $q): ?>
        <div class="slide <?= $i === 0 ? 'active' : '' ?>">
          <p class="question">
            <strong><?= ($i + 1) ?>. <?= htmlspecialchars($q['question']) ?></strong>
          </p>
          <div class="options">
            <label>
              <input type="radio"
                     name="answers[<?= $q['id'] ?>]"
                     value="A"> <?= htmlspecialchars($q['option_a']) ?>
            </label>
            <label>
              <input type="radio"
                     name="answers[<?= $q['id'] ?>]"
                     value="B"> <?= htmlspecialchars($q['option_b']) ?>
            </label>
            <label>
              <input type="radio"
                     name="answers[<?= $q['id'] ?>]"
                     value="C"> <?= htmlspecialchars($q['option_c']) ?>
            </label>
            <label>
              <input type="radio"
                     name="answers[<?= $q['id'] ?>]"
                     value="D"> <?= htmlspecialchars($q['option_d']) ?>
            </label>
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

  <!-- Slider logic -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const slides  = Array.from(document.querySelectorAll('.slide'));
      const prevBtn = document.getElementById('prev-btn');
      const nextBtn = document.getElementById('next-btn');
      const form    = document.getElementById('quiz-form');
      let   curr   = 0;

      function showSlide(n) {
        slides.forEach((s,i) => s.classList.toggle('active', i === n));
        prevBtn.disabled = n === 0;
        nextBtn.textContent = (n === slides.length - 1) ? 'Submit' : 'Next';
      }

      prevBtn.addEventListener('click', () => {
        if (curr > 0) { curr--; showSlide(curr); }
      });
      nextBtn.addEventListener('click', () => {
        if (curr === slides.length - 1) {
          form.submit();
        } else {
          curr++;
          showSlide(curr);
        }
      });
    });
  </script>
</body>
</html>
