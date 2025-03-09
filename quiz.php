<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Clear local storage for cookies preference upon loading the quiz
echo "<script>localStorage.removeItem('cookiesAccepted');</script>";

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "FYP";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch questions from the database
$sql = "SELECT * FROM quiz_questions"; // Assuming your table is named 'questions'
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $questions = [];
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
} else {
    echo "No questions found!";
    exit();
}

$conn->close();

// Process quiz answers
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $answers = $_POST['answers']; // Array of answers
    $correctAnswers = 0;

    foreach ($answers as $questionId => $answer) {
        // Fetch correct answer from the database
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare("SELECT correct_option FROM quiz_questions WHERE id = ?");
        $stmt->bind_param("i", $questionId);
        $stmt->execute();
        $stmt->bind_result($correct_option);
        $stmt->fetch();
        
        if ($answer == $correct_option) {
            $correctAnswers++;
        }
        
        $stmt->close();
        $conn->close();
    }

    // Save score to database
    $conn = new mysqli($servername, $username, $password, $dbname);
    $stmt = $conn->prepare("UPDATE users SET score = ? WHERE username = ?");
    $stmt->bind_param("is", $correctAnswers, $_SESSION['username']);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Display score
    echo "<h2>Your Score: $correctAnswers</h2>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .quiz-container { max-width: 600px; margin: auto; }
        .question { font-size: 20px; margin-bottom: 10px; }
        .options label { display: block; margin: 5px 0; }
    </style>
</head>
<body>

    <!-- Navbar copied from home.php -->
    <header>
        <nav>
            <div class="logo">
                <img src="images/cookies-logo.png" alt="Cookies Logo" class="logo-img"> 
                <span class="red-text">ookies... Are they really safe?</span>
            </div>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>

                <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
                    <!-- Show the username and logout link if logged in -->
                    <li><span class="username">Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></span></li>
                    <li><a href="logout.php">Logout</a></li> <!-- Logout link -->
                <?php else: ?>
                    <!-- Show login and signup links if not logged in -->
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.html">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <div class="quiz-container">
        <h1>Quiz</h1>
        <form action="quiz.php" method="POST">
            <?php foreach ($questions as $index => $question): ?>
                <div class="question">
                    <p><strong><?php echo ($index + 1) . ". " . $question['question']; ?></strong></p>
                    <div class="options">
                        <label><input type="radio" name="answers[<?php echo $question['id']; ?>]" value="A"> <?php echo $question['option_a']; ?></label>
                        <label><input type="radio" name="answers[<?php echo $question['id']; ?>]" value="B"> <?php echo $question['option_b']; ?></label>
                        <label><input type="radio" name="answers[<?php echo $question['id']; ?>]" value="C"> <?php echo $question['option_c']; ?></label>
                        <label><input type="radio" name="answers[<?php echo $question['id']; ?>]" value="D"> <?php echo $question['option_d']; ?></label>
                    </div>
                </div>
            <?php endforeach; ?>

            <button type="submit">Submit Quiz</button>
        </form>
    </div>

</body>
</html>
