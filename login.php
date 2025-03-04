<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "FYP";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_username = $_POST['username'];
    $user_password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password, score FROM users WHERE username = ?");
    $stmt->bind_param("s", $user_username);
    $stmt->execute();
    $stmt->bind_result($db_password, $score);
    $stmt->fetch();
    
    if (password_verify($user_password, $db_password)) {
        $_SESSION['username'] = $user_username;
        $_SESSION['score'] = $score;

        // Clear local storage for cookies preference upon login
        echo "<script>
                localStorage.removeItem('cookiesAccepted');
                window.location.href = 'home.php'; 
                </script>";
        exit();
    } else {
        $error = "Invalid login.";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
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
                    <li><span class="username">Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></span></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <div class="login-page">
        <div class="login-box">
            <h2>Login</h2>
            <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
            <form action="login.php" method="POST" class="login-form">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
