<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="overlay" class="overlay"></div> <!-- Dark overlay until user accepts cookies -->

    <div id="cookie-popup" class="cookie-popup"> <!-- Cookie consent pop-up -->
        <p id="cookie-message">This website uses cookies to enhance your experience. Do you accept?</p>
        <button id="accept-btn">Accept</button>
        <button id="decline-btn">Decline</button>
    </div>

    <button id="reset-cookies" class="reset-btn">Reset Cookies</button> <!-- Developer only -->

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
                    <li><span class="username">Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></span></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <!-- Show login and signup links if not logged in -->
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <section class="welcome-banner">
        <div class="welcome-content">
            <h1 class="welcome-headline">
                <span id="typewriter-text"></span>
            </h1>
            <p class="welcome-description">
                Cookies are everywhere, but do you really know what they do? This website uses cookies to enhance your experience, but we also want to educate you about their risks. Before you continue, please let us know if you accept cookies below.
            </p>
            <div class="arrow-container">
                <span class="arrow right-arrow">→</span>
                <a href="#" id="learn-more-btn" class="btn get-started">Learn About Cookies</a>
                <span class="arrow left-arrow">←</span>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 MyWebsite. All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>