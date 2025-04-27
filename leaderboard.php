<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Database credentials
$server = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "FYP";

// Connect
$conn = new mysqli($server, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
  die("DB Error: " . $conn->connect_error);
}

// 1) Total number of questions
$qRes   = $conn->query("SELECT COUNT(*) AS cnt FROM quiz_questions");
$totalQ = $qRes ? (int)$qRes->fetch_assoc()['cnt'] : 1;

// 2) get top 10 users for leaderboard 
$sql     = "
  SELECT username, score
  FROM users
  ORDER BY score DESC, username ASC
  LIMIT 10
";
$res     = $conn->query($sql);
$leaders = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Leaderboard</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

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
        <li><a href="leaderboard.php" class="active">Leaderboard</a></li>
      </ul>
      <ul class="nav-auth">
        <li>
          <span class="username">
            Hi, <?= htmlspecialchars($_SESSION['username']) ?>
          </span>
        </li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <div class="leaderboard-container">
    <h1>Leaderboard</h1>
    <table class="leaderboard-table">
      <thead>
        <tr>
          <th>Rank</th>
          <th>Username</th>
          <th>Score</th>
          <th>Percent</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($leaders)): ?>
          <tr>
            <td colspan="4">No scores yet.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($leaders as $i => $row):
            // calculate percentage
            $pct = round(($row['score'] / max($totalQ, 1)) * 100);
          ?>
            <tr class="<?= $row['username'] === $_SESSION['username'] ? 'you' : '' ?>">
              <td><?= $i + 1 ?></td>
              <td><?= htmlspecialchars($row['username']) ?></td>
              <td><?= (int)$row['score'] ?></td>
              <td><?= $pct ?>%</td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
    <a href="quiz.php" class="btn primary">Take Quiz</a>
  </div>

  <footer>
    <p>&copy; 2025 MyWebsite. All rights reserved.</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
