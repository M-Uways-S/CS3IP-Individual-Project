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

    <header>
        <nav>
            <div class="logo">
                <img src="images/cookies-logo.png" alt="Cookies Logo" class="logo-img"> 
                <span class="red-text">ookies Shield</span>
            </div>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="learn.php">Learn</a></li>
                <li><a href="quiz.php">Quiz</a></li>


                <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
                    <!-- Show the username and logout link if logged in -->
                    <li><span class="username">Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></span></li>
                    <li><a href="logout.php">Logout</a></li> <!-- Logout link -->
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
        <p class="welcome-description">Cookies are everywhere, but do you really know what they do? This website uses cookies to enhance your experience, but we also want to educate you about their risks. Before you continue, please let us know if you accept cookies below.</p>
        <div class="arrow-container">
            <span class="arrow right-arrow">→</span>
            <a href="#" id="learn-more-btn" class="btn get-started">Learn About Cookies</a>
            <span class="arrow left-arrow">←</span>
        </div>
    </div>
</section>

<section id="cookie-info" class="cookie-info hidden">
    <div class="cookie-info-content">
        <h2 id="typewriter-heading" class="typewriter-text"></h2> <!-- Typewriter text -->
        <p id="typewriter-text" class="typewriter-text"></p> <!-- Typewriter paragraph text -->
        
        <h2>Potential Dangers of Accepting Cookies</h2>
        <ul>
            <li><strong>Privacy Risks:</strong> Cookies can track your browsing habits, potentially exposing your personal information.</li>
            <li><strong>Third-Party Tracking:</strong> Some cookies are used by advertisers to build profiles of your interests and behaviors.</li>
            <li><strong>Data Security:</strong> If not properly managed, cookies may become vulnerable to security breaches or misuse.</li>
        </ul>
        
        <h2>How to Protect Yourself</h2>
        <p>You can manage or disable cookies through your browser settings. By doing so, you may limit tracking and enhance your privacy, but it could affect your browsing experience on some websites.</p>
    </div>
</section>


</section>

    <footer>
        <p>&copy; 2025 MyWebsite. All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
