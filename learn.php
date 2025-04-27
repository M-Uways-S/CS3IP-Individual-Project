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
  <!-- cookie consent banner -->
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

  <!-- learn bar and progress bar for quiz -->
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

<section class="learn-details">
  
<!-- lesson 1 -->
<div class="accordion" id="lesson1">
  <button class="accordion-toggle">1. What Is a Cookie?</button>
  <div class="accordion-panel">
    <div class="learn-flex">
      <div class="learn-text">

        <p style="margin-bottom: 1rem;">
          Before diving into the world of web privacy, it's important to understand what cookies are and how they interact with your browser. Let's break it down simply!
        </p>

        <p><strong style="color: #ff6f61;">Definition:</strong> A cookie is a small text file that a website stores on your device when you visit. Cookies allow sites to remember your preferences, keep you logged in, and track basic usage patterns.</p>
        <p><strong style="color: #ff6f61;">Why Use Cookies?</strong></p>
        <ul>
          <li>Remember login sessions so you don’t have to sign in on every page.</li>
          <li>Store language or theme preferences (e.g., dark mode).</li>
          <li>Enable e-commerce carts to persist items between visits.</li>
        </ul>
        <p><strong style="color: #ff6f61;">Types of Cookies:</strong></p>
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
        <!-- Lesson 1 info sourced from:
        - https://developer.mozilla.org/en-US/docs/Web/HTTP/Cookies
        - https://www.kaspersky.com/resource-center/definitions/cookies
        -->
      </div>
    </div>
  </div>
</div>


<!-- lesson 2 -->
<div class="accordion" id="lesson2">
  <button class="accordion-toggle">2. Browser Storage</button>
  <div class="accordion-panel">
    <div class="learn-flex">
      <div class="learn-text">

        <p style="margin-bottom: 1rem;">
          Besides cookies, browsers offer other ways to store information locally. Understanding these helps you spot where data hides and how to manage it!
        </p>

        <p><strong style="color: #ff6f61;">Modern browsers offer several ways to store data client-side:</strong></p>
        <ol>
          <li><strong>Cookies:</strong> Small, automatically sent on every HTTP request.</li>
          <li><strong>localStorage:</strong> Persistent key/value store, not sent to server, survives restarts.</li>
          <li><strong>sessionStorage:</strong> Similar to localStorage but cleared when the tab/window closes.</li>
        </ol>
        <p><strong style="color: #ff6f61;">How to Inspect Cookies & Storage:</strong></p>
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
        <!-- lesson 2 info sourced from:
        - https://developer.mozilla.org/en-US/docs/Learn/JavaScript/Client-side_web_APIs/Client-side_storage
        - https://developer.chrome.com/docs/devtools/storage/cookies/
        -->
      </div>
    </div>
  </div>
</div>


<!-- lesson 3 -->
<div class="accordion" id="lesson3">
  <button class="accordion-toggle">3. Privacy Implications</button>
  <div class="accordion-panel">
    <div class="learn-flex">
      <div class="learn-text">

        <p style="margin-bottom: 1rem;">
          Cookies aren't always harmless! Some are used for tracking you across the internet without your knowledge. Let's explore the privacy risks together.
        </p>

        <p><strong style="color: #ff6f61;">Common Tracking Techniques:</strong></p>
        <ul>
          <li><strong>Third-Party Cookies:</strong> A single cookie set by an ad network appears on many sites.</li>
          <li><strong>Browser Fingerprinting:</strong> Combines device info, fonts, and plugins for identification without cookies.</li>
        </ul>
        <p><strong style="color: #ff6f61;">Regulations Overview:</strong></p>
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
        <!-- lesson 3 info sourced from:
        - https://www.eff.org/wp/behind-the-one-way-mirror
        - https://gdpr.eu/cookies/
        - https://www.cloudflare.com/learning/privacy/what-is-browser-fingerprinting/
        -->
      </div>
    </div>
  </div>
</div>


<!-- lesson 4 -->
<div class="accordion" id="lesson4">
  <button class="accordion-toggle">4. Managing Cookies</button>
  <div class="accordion-panel">
    <div class="learn-flex">
      <div class="learn-text">

        <p style="margin-bottom: 1rem;">
          Knowing how to control cookies puts you back in charge of your privacy. Here’s how you can manage or delete cookies depending on the browser you use!
        </p>

        <p><strong style="color: #ff6f61;">You have full control over cookies in your browser settings:</strong></p>
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
        <!-- lesson 4 info sourced from:
        - https://support.google.com/chrome/answer/95647?hl=en
        - https://support.mozilla.org/en-US/kb/clear-cookies-and-site-data-firefox
        - https://support.apple.com/en-gb/guide/safari/sfri11471/mac
        -->
      </div>
    </div>
  </div>
</div>



      <!-- 5. try it yourself section -->
      <div class="accordion-panel open" style="margin-bottom: 2rem;">
    <div class="cookie-sim" id="simulator" style="padding: 1.5rem;">
      <h3 style="color: #ff6f61; margin-bottom: 1rem;">5. Try It Yourself</h3>
      <p style="margin-bottom: 1.5rem;">
        Now that you've learned about cookies and browser storage, here's a quick hands-on task to reinforce your knowledge!
        Try resetting your cookie consent — just like real websites sometimes force users to do after a policy update.
      </p>
      <button id="reset-consent-btn" class="btn primary" style="margin-bottom: 1.5rem;">Reset Cookie Consent</button>
      <pre id="cookie-output" style="background: #111; padding: 0.75rem; border-radius: 4px; margin-bottom: 1.5rem;"></pre>
      <p style="margin-bottom: 0.5rem;"><strong>Why this matters:</strong></p>
      <ul style="padding-left: 1.5rem; margin-bottom: 0;">
        <li style="margin-bottom: 0.5rem;">Read cookie details before re-consenting.</li>
        <li style="margin-bottom: 0.5rem;">Use privacy extensions or block non-essential cookies.</li>
        <li>Always look for “Reject” or granular settings.</li>
      </ul>
    </div>
  </div>

<!-- 6. glossary -->
    <div class="accordion-panel open" style="margin-bottom: 2rem;">
    <div id="glossary" style="padding: 1.5rem;">
      <h3 style="color: #ff6f61; margin-bottom: 1rem;">6. Glossary</h3>
      <p style="margin-bottom: 1.5rem;">
        Before you head to the quiz, here’s a quick recap of key terms you might have learned — and maybe even forgotten! 
        Reviewing these will help you answer confidently.
      </p>
      <div style="display: flex; flex-wrap: wrap; gap: 2rem;">
        <div style="flex: 1 1 300px;">
          <dl>
            <dt style="color: #ff6f61; margin-top: 1rem;">Cookie</dt>
            <dd>Small text file stored by your browser.</dd>
            <dt style="color: #ff6f61; margin-top: 1rem;">Third-Party Cookie</dt>
            <dd>Set by a domain other than your address bar.</dd>
            <dt style="color: #ff6f61; margin-top: 1rem;">Session Cookie</dt>
            <dd>Deleted when browser closes.</dd>
            <dt style="color: #ff6f61; margin-top: 1rem;">Persistent Cookie</dt>
            <dd>Remains until expiry or deletion.</dd>
            <dt style="color: #ff6f61; margin-top: 1rem;">Browser Storage</dt>
            <dd>Saving data locally in the browser (cookies, localStorage, sessionStorage).</dd>
          </dl>
        </div>
        <div style="flex: 1 1 300px;">
          <dl>
            <dt style="color: #ff6f61; margin-top: 1rem;">Fingerprinting</dt>
            <dd>Tracking users by their device and browser settings.</dd>
            <dt style="color: #ff6f61; margin-top: 1rem;">HttpOnly</dt>
            <dd>A cookie flag that prevents client-side access via JavaScript.</dd>
            <dt style="color: #ff6f61; margin-top: 1rem;">Secure Cookie</dt>
            <dd>Only transmitted over HTTPS connections for better safety.</dd>
            <dt style="color: #ff6f61; margin-top: 1rem;">Incognito Mode</dt>
            <dd>Private browsing that deletes cookies and history after closing.</dd>
            <dt style="color: #ff6f61; margin-top: 1rem;">GDPR</dt>
            <dd>European law requiring websites to get cookie consent.</dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
    <!-- glossary definitions sourced from:
    - https://developer.mozilla.org/en-US/docs/Web/HTTP/Cookies
    - https://www.kaspersky.com/resource-center/definitions/cookies
    -->
  </section>

  <footer class="site-footer">
  <div style="max-width: none; width: 100%; padding: 2rem 1rem 1rem; text-align: center; background: #222; color: #ccc;">
    <hr style="border-color: #333; margin-bottom: 1rem;">
    <p>&copy; 2025 Cookie Shield. All rights reserved.</p>
  </div>
</footer>


  <script src="script.js"></script>
</body>
</html>
