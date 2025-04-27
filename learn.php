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
<body data-user="<?= !empty($_SESSION['username']) ? htmlspecialchars($_SESSION['username'], ENT_QUOTES) : 'guest' ?>">
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
          <li><span class="username">Hi, <?=htmlspecialchars($_SESSION['username'], ENT_QUOTES)?></span></li>
          <li><a href="logout.php" id="logout-link">Logout</a></li>
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
      <div class="info-card">
        <i class="fas fa-cookie info-icon"></i>
        <h3>1. What Is a Cookie?</h3>
        <p>How cookies store small bits of data in your browser.</p>
      </div>
      <div class="info-card">
        <i class="fas fa-code info-icon"></i>
        <h3>2. Browser Storage</h3>
        <p>Where cookies live on disk and how to inspect them.</p>
      </div>
      <div class="info-card">
        <i class="fas fa-user-shield info-icon"></i>
        <h3>3. Privacy Implications</h3>
        <p>Third-party tracking, fingerprinting, and data collection.</p>
      </div>
      <div class="info-card">
        <i class="fas fa-sliders-h info-icon"></i>
        <h3>4. Managing Cookies</h3>
        <p>Browser settings, incognito, and privacy extensions.</p>
      </div>
    </div>
  </section>

  <!-- Learn Progress Bar + Quiz Gate -->
  <section class="learn-progress">
    <div id="progress-bar-container">
      <div class="progress-step" data-step="1">
        <span class="number">1</span>
        <span class="label">Cookie?</span>
      </div>
      <div class="progress-step" data-step="2">
        <span class="number">2</span>
        <span class="label">Storage</span>
      </div>
      <div class="progress-step" data-step="3">
        <span class="number">3</span>
        <span class="label">Privacy</span>
      </div>
      <div class="progress-step" data-step="4">
        <span class="number">4</span>
        <span class="label">Manage</span>
      </div>
    </div>
    <div class="learning-end-progress">
      <a href="#" id="take-quiz-btn" class="btn primary disabled">Take the Quiz</a>
      <p class="quiz-note">Please review <strong>all four</strong> lessons above before you can start the quiz.</p>
    </div>
  </section>
<!-- Lesson Details + Accordion -->
<section class="learn-details">
  
<!-- Lesson Details + Accordion -->
<section class="learn-details">
  
  <!-- Lesson 1 -->
  <div class="accordion" id="lesson1">
    <button class="accordion-toggle">1. What Is a Cookie?</button>
    <div class="accordion-panel">
      <div class="learn-flex">
        <div class="learn-text">
          <p><strong>Definition:</strong> A cookie is a small text file that a website stores on your device when you visit. Cookies allow sites to remember your preferences, keep you logged in, and track basic usage patterns.</p>
          <p><strong>Why Use Cookies?</strong></p>
          <ul>
            <li>Remember login sessions so you don’t have to sign in on every page.</li>
            <li>Store language or theme preferences (e.g., dark mode).</li>
            <li>Enable e-commerce carts to persist items between visits.</li>
          </ul>
          <p><strong>Types of Cookies:</strong></p>
          <ul>
            <li><strong>Session Cookies:</strong> Temporarily stored and deleted when you close your browser.</li>
            <li><strong>Persistent Cookies:</strong> Remain on your device until they expire or you manually delete them (often used for “remember me” features).</li>
            <li><strong>First-Party vs. Third-Party:</strong>  
              <ul>
                <li><em>First-Party:</em> Set by the site you’re visiting.</li>
                <li><em>Third-Party:</em> Set by external services (e.g., analytics, ads) embedded in the page.</li>
              </ul>
            </li>
          </ul>
          <p><em>Security Note:</em> Cookies can be flagged “HttpOnly” and “Secure” to mitigate theft via XSS or unencrypted transport.</p>
        </div>
        <div class="video-container">
          <iframe
            src="https://www.youtube.com/embed/_zZ6dnW5Nic"
            title="What are cookies? Website Cookies explained in 2 minutes!"
            allowfullscreen>
          </iframe>
        </div>
      </div>
    </div>
  </div>

  <!-- Lesson 2 -->
  <div class="accordion" id="lesson2">
    <button class="accordion-toggle">2. Browser Storage</button>
    <div class="accordion-panel">
      <div class="learn-flex">
        <div class="learn-text">
          <p>Modern browsers offer several ways to store data client-side:</p>
          <ol>
            <li><strong>Cookies:</strong> Small, automatically sent on every HTTP request.</li>
            <li><strong>localStorage:</strong> Persistent key/value store, not sent to server, survives restarts.</li>
            <li><strong>sessionStorage:</strong> Similar to localStorage but cleared when the tab/window closes.</li>
          </ol>
          <p><strong>How to Inspect Cookies & Storage:</strong></p>
          <ul>
            <li>Open Developer Tools (<kbd>F12</kbd> or <kbd>Ctrl+Shift+I</kbd>).</li>
            <li>Navigate to <kbd>Application</kbd> (Chrome) or <kbd>Storage</kbd> (Firefox).</li>
            <li>Under <em>Cookies</em>, see each domain’s list; under <em>Local Storage</em> and <em>Session Storage</em>, view your app’s key/values.</li>
          </ul>
          <p><em>Tip:</em> Use the “Clear on exit” option to automatically wipe cookies or Storage when you close the browser.</p>
        </div>
        <div class="video-container">
          <iframe
            src="https://www.youtube.com/embed/sovAIX4doOE"
            title="HTTP Cookies Crash Course"
            allowfullscreen>
          </iframe>
        </div>
      </div>
    </div>
  </div>

  <!-- Lesson 3 -->
  <div class="accordion" id="lesson3">
    <button class="accordion-toggle">3. Privacy Implications</button>
    <div class="accordion-panel">
      <div class="learn-flex">
        <div class="learn-text">
          <p>Cookies can be used to track users’ browsing behavior across sites—raising privacy concerns.</p>
          <p><strong>Common Tracking Techniques:</strong></p>
          <ul>
            <li><strong>Third-Party Cookies:</strong> A single cookie set by an ad network appears on many sites.</li>
            <li><strong>Browser Fingerprinting:</strong> Combines device info, fonts, and plugins for identification without cookies.</li>
          </ul>
          <p><strong>Regulations Overview:</strong></p>
          <ul>
            <li><strong>GDPR (EU):</strong> Requires explicit opt-in for non-essential cookies and clear privacy notices.</li>
            <li><strong>CCPA (California):</strong> Gives Californians the right to opt-out of sale of personal data.</li>
          </ul>
          <p><em>Did you know?</em> Some sites use “evercookies”—cookies stored in multiple places (e.g., Flash, HTML5, ETags)—to make them hard to delete.</p>
        </div>
        <div class="video-container">
          <iframe
            src="https://www.youtube.com/embed/QWw7Wd2gUJk"
            title="How cookies can track you (Simply Explained)"
            allowfullscreen>
          </iframe>
        </div>
      </div>
    </div>
  </div>

  <!-- Lesson 4 -->
  <div class="accordion" id="lesson4">
    <button class="accordion-toggle">4. Managing Cookies</button>
    <div class="accordion-panel">
      <div class="learn-flex">
        <div class="learn-text">
          <p>You have full control over cookies in your browser settings:</p>
          <ol>
            <li><strong>Chrome (Desktop &amp; Mobile):</strong>
              <ul>
                <li>Settings → Privacy and security → Cookies and other site data.</li>
                <li>Toggle “Block third-party cookies” or “Clear cookies and site data when you close all windows.”</li>
              </ul>
            </li>
            <li><strong>Firefox:</strong>
              <ul>
                <li>Preferences → Privacy &amp; Security → Cookies and Site Data.</li>
                <li>Click “Manage Data…” to remove specific site cookies.</li>
              </ul>
            </li>
            <li><strong>Safari:</strong>
              <ul>
                <li>Preferences → Privacy → Cookies and website data → “Manage Website Data…”</li>
              </ul>
            </li>
            <li><strong>Edge:</strong>
              <ul>
                <li>Settings → Site permissions → Cookies and site data.</li>
              </ul>
            </li>
          </ol>
          <p><em>Quick tip:</em> Use “Incognito” or “Private Browsing” mode to test your site without persistent cookies.</p>
        </div>
        <div class="video-container">
          <iframe
            src="https://www.youtube.com/embed/NZJrBf--n1M"
            title="How to Disable Third-Party Cookies in Chrome"
            allowfullscreen>
          </iframe>
        </div>
      </div>
    </div>
  </div>


    <!-- 5. Try It Yourself -->
    <div class="cookie-sim" id="simulator">
      <h4>5. Try It Yourself</h4>
      <p>
        Click the button below to reset your earlier “Accept All” choice — just like some sites force
        you to re-consent after a policy update.
      </p>
      <button id="reset-consent-btn">Reset Cookie Consent</button>
      <pre id="cookie-output"></pre>
      <p class="sim-explain">
        <strong>Why this matters:</strong> Sites can wipe your previous choice, coercing you into Accept All.
        To stay safe:
        <ul>
          <li>Read cookie details before re-consenting.</li>
          <li>Use privacy extensions or block non-essential cookies.</li>
          <li>Always look for “Reject” or granular settings.</li>
        </ul>
      </p>
    </div>

    <!-- Glossary -->
    <div id="glossary">
      <h3>6. Glossary</h3>
      <dl>
        <dt>Cookie</dt><dd>Small text file stored by your browser.</dd>
        <dt>Third-Party Cookie</dt><dd>Set by a domain other than your address bar.</dd>
        <dt>Session Cookie</dt><dd>Deleted when browser closes.</dd>
        <dt>Persistent Cookie</dt><dd>Remains until expiry or deletion.</dd>
      </dl>
    </div>
  </section>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="footer-container">
      <!-- footer columns -->
    </div>
    <div class="footer-bottom">
      <p>&copy; 2025 Cookie Shield. All rights reserved.</p>
    </div>
  </footer>

  <script src="script.js"></script>
</body>
</html>
