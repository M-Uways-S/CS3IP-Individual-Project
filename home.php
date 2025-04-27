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
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-…"
    crossorigin="anonymous"
    referrerpolicy="no-referrer"/>
</head>


<body>
    <!--overlay till user accepts cookies -->
    <div id="overlay" class="overlay hidden"></div>

    <!-- cookie consent banner -->
    <div id="cookie-consent" class="cookie-consent hidden">
        <div class="cookie-consent-content">
            <p>
                We use cookies to personalise content, analyse traffic, and improve your experience.
                By clicking “Accept All” you agree to our use of cookies.
                You can also <a href="/cookie-policy.php" target="_blank">read our policy</a> or
                <button id="cookie-manage-btn" class="link-btn">Manage preferences</button>.
            </p>
            <div class="cookie-buttons">
                <button id="cookie-reject" class="btn-secondary">Reject All</button>
                <button id="cookie-accept" class="btn-primary">Accept All</button>
            </div>
        </div>
    </div>

    <header class="site-header">
        <nav class="site-nav">
            <!-- my logo image  -->
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
                    <!-- if logged in will show logout only and say hi to user with there name ^above^ -->
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <section class="welcome-banner">
        <div class="welcome-content">
            <div class="welcome-text">
                <h1>Protect Your Digital Privacy</h1>
                <h2>Understanding Cookie Consent Matters</h2>
                <p>
                    In today’s digital world, your data is constantly being tracked, collected,
                    and analyzed. Learn how to protect yourself by understanding what you’re really
                    agreeing to when you click “Accept All.”
                </p>
                <div class="welcome-buttons">
                    <a href="learn.php" class="btn primary">Learn More</a>
                    <a href="quiz.php" class="btn secondary">Take the Quiz</a>
                </div>
            </div>
            <div class="welcome-image">
                <img src="images/cookie2.gif" alt="Cookie Consent Illustration">
                <!-- ref for img.gif:  https://www.flaticon.com/free-animated-icon/cookie_17507059?term=cookie&page=1&position=9&origin=search&related_id=17507059-->
            </div>
        </div>
    </section>

    <section class="info-banner">
        <h2 class="info-title">Why You Should Care About Cookie Consent</h2>
        <div class="info-cards">
            <div class="info-card">
                <i class="fas fa-user-secret info-icon"></i>
                <h3>Privacy Compromise</h3>
                <p>Accepting cookies without reading the details can compromise your online privacy.</p>
            </div>
            <div class="info-card">
                <i class="fas fa-fingerprint info-icon"></i>
                <h3>Digital Fingerprinting</h3>
                <p>Cookies can create a unique digital fingerprint that tracks you across websites.</p>
            </div>
            <div class="info-card">
                <i class="fas fa-database info-icon"></i>
                <h3>Data Collection</h3>
                <p>Your browsing habits, preferences, and personal information are collected and stored.</p>
            </div>
            <div class="info-card">
                <i class="fas fa-ad info-icon"></i>
                <h3>Targeted Advertising</h3>
                <p>Your data is used to create targeted advertisements tailored to your behavior.</p>
            </div>
        </div>
    </section>

        <section class="feedback-section">
            <h2 class="feedback-title">We Value Your Feedback</h2>
            <p class="feedback-description">Help us improve! Please share your thoughts below.</p>

            <form action="submit_feedback.php" method="POST" class="feedback-form">
                <div class="form-card">
                    <textarea name="feedback_text" class="feedback-textarea" rows="6" placeholder="Write your feedback here..." required></textarea>
                    <button type="submit" class="btn primary feedback-btn">Submit Feedback</button>
                </div>
            </form>
        </section>


    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="/about.php">About Us</a></li>
                    <li><a href="/careers.php">Careers</a></li>
                    <li><a href="/blog.php">Blog</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Support</h4>
                <ul>
                    <li><a href="/help.php">Help Center</a></li>
                    <li><a href="/contact.php">Contact Us</a></li>
                    <li><a href="/faq.php">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Legal</h4>
                <ul>
                    <li><a href="/terms.php">Terms of Service</a></li>
                    <li><a href="/privacy.php">Privacy Policy</a></li>
                    <li><a href="/cookies.php">Cookie Policy</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Social</h4>
                <ul>
                    <li><a href="https://twitter.com/YourCompany" target="_blank">Twitter</a></li>
                    <li><a href="https://facebook.com/YourCompany" target="_blank">Facebook</a></li>
                    <li><a href="https://linkedin.com/company/YourCompany" target="_blank">LinkedIn</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Cookie Shield. All rights reserved.</p>
        </div>
    </footer>
    
    <script src="script.js"></script>
</body>
</html>