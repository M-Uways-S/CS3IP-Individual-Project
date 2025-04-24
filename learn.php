<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Learn — Cookie Shield</title>
  <link rel="stylesheet" href="styles.css">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
</head>
<body>
  <!-- Cookie Consent Banner -->
  <div id="overlay" class="overlay hidden"></div>
  <div id="cookie-consent" class="cookie-consent hidden">
    <div class="cookie-consent-content">
      <p>
        We use cookies to personalise content, analyse traffic, and improve your experience.
        By clicking “Accept All” you agree to our use of cookies. You can also
        <a href="/cookie-policy.php" target="_blank">read our policy</a>.
      </p>
      <div class="cookie-buttons">
        <button id="cookie-reject" class="btn-secondary">Reject All</button>
        <button id="cookie-accept" class="btn-primary">Accept All</button>
      </div>
    </div>
  </div>
  <button id="cookie-reset-btn" class="btn-reset">Reset Cookies</button>

  <!-- Header/Nav -->
  <header class="site-header">
    <nav class="site-nav">
      <a href="home.php" class="logo">
        <img src="images/cookies-logo.png" alt="Logo" class="logo-img">
        Cookie Shield
      </a>
      <ul class="nav-main">
        <li><a href="home.php">Home</a></li>
        <li><a href="learn.php" class="active">Learn</a></li>
        <li><a href="quiz.php">Quiz</a></li>
        <li><a href="leaderboard.php">Leaderboard</a></li>
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

  <!-- Overview Cards -->
  <section class="info-banner">
    <h2 class="info-title">Interactive Cookie Lessons</h2>
    <div class="info-cards">
      <div class="info-card"><i class="fas fa-cookie info-icon"></i>
        <h3>1. What Is a Cookie?</h3>
        <p>How cookies store small bits of data in your browser.</p>
      </div>
      <div class="info-card"><i class="fas fa-code info-icon"></i>
        <h3>2. Browser Storage</h3>
        <p>Where cookies live on disk and how to inspect them.</p>
      </div>
      <div class="info-card"><i class="fas fa-user-shield info-icon"></i>
        <h3>3. Privacy Implications</h3>
        <p>Third-party tracking, fingerprinting, and data collection.</p>
      </div>
      <div class="info-card"><i class="fas fa-sliders-h info-icon"></i>
        <h3>4. Managing Cookies</h3>
        <p>Browser settings, incognito, and privacy extensions.</p>
      </div>
    </div>
  </section>

  <!-- Main Learn Content -->
  <main class="learn-main">
    <!-- Table of Contents -->
    <nav class="toc">
      <h4>Contents</h4>
      <ul>
        <li><a href="#lesson1">1. What Is a Cookie?</a></li>
        <li><a href="#lesson2">2. Browser Storage</a></li>
        <li><a href="#lesson3">3. Privacy Implications</a></li>
        <li><a href="#lesson4">4. Managing Cookies</a></li>
        <li><a href="#simulator">5. Cookie Simulator</a></li>
        <li><a href="#glossary">6. Glossary</a></li>
      </ul>
    </nav>

    <!-- Lesson Details + Accordion -->
    <section class="learn-details">
      <div class="accordion" id="lesson1">
        <button class="accordion-toggle">1. What Is a Cookie?</button>
        <div class="accordion-panel">
          <p>A cookie is a small text file that a website stores on your computer. It helps remember your preferences and login status.</p>
        </div>
      </div>

      <div class="accordion" id="lesson2">
        <button class="accordion-toggle">2. Browser Storage</button>
        <div class="accordion-panel">
          <p>Browsers isolate cookies per domain. Use developer tools to view and delete them for privacy.</p>
        </div>
      </div>

      <div class="accordion" id="lesson3">
        <button class="accordion-toggle">3. Privacy Implications</button>
        <div class="accordion-panel">
          <p>Third-party cookies track you across sites, building a profile without your explicit consent.</p>
        </div>
      </div>

      <div class="accordion" id="lesson4">
        <button class="accordion-toggle">4. Managing Cookies</button>
        <div class="accordion-panel">
          <ul>
            <li>Block third-party cookies in settings.</li>
            <li>Use incognito/private mode for one-off browsing.</li>
            <li>Try extensions like Privacy Badger or uBlock Origin.</li>
          </ul>
        </div>
      </div>

      <!-- Interactive Cookie Simulator -->
      <div class="cookie-sim" id="simulator">
        <h4>5. Try It Yourself</h4>
        <input id="cookie-name" placeholder="Cookie name">
        <input id="cookie-value" placeholder="Cookie value">
        <button id="set-cookie">Set Cookie</button>
        <button id="view-cookies">View Cookies</button>
        <pre id="cookie-output"></pre>
      </div>

      <!-- Glossary -->
      <section id="glossary" class="learn-details">
        <h3>6. Glossary</h3>
        <dl>
          <dt>Cookie</dt>
          <dd>Small text file stored by your browser.</dd>
          <dt>Third-Party Cookie</dt>
          <dd>Set by a domain other than the one in your address bar.</dd>
          <dt>Session Cookie</dt>
          <dd>Deleted when you close your browser.</dd>
          <dt>Persistent Cookie</dt>
          <dd>Remains until it expires or you delete it.</dd>
        </dl>
      </section>

      <!-- Take Quiz Button -->
      <div class="learning-end">
        <a href="quiz.php" class="btn primary">Take the Quiz</a>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="footer-container">
      <!-- your existing footer columns -->
    </div>
    <div class="footer-bottom">
      <p>&copy; 2025 Cookie Shield. All rights reserved.</p>
    </div>
  </footer>

  <script src="script.js"></script>
</body>
</html>
