// ───────── Cookie Consent (educational coercion demo) ─────────
document.addEventListener("DOMContentLoaded", function () {
    const overlay   = document.getElementById("overlay");
    const banner    = document.getElementById("cookie-consent");
    if (!banner) return;  // nothing to do if banner isn’t on the page
  
    const acceptBtn  = document.getElementById("cookie-accept");
    const rejectBtn  = document.getElementById("cookie-reject");
    const resetBtn   = document.getElementById("cookie-reset-btn");
    const msgEl      = banner.querySelector(".cookie-consent-content p");
  
    // Helpers to show/hide
    function showAll() {
      banner.classList.remove("hidden");
      overlay.classList.remove("hidden");
      document.body.style.overflow = "hidden";
    }
    function hideAll() {
      banner.classList.add("hidden");
      overlay.classList.add("hidden");
      document.body.style.overflow = "auto";
    }
  
    // Initial display if not yet accepted
    if (localStorage.getItem("cookiesAccepted") !== "true") {
      showAll();
    }
  
    // Accept All → store flag and hide
    acceptBtn.addEventListener("click", () => {
      localStorage.setItem("cookiesAccepted", "true");
      hideAll();
    });
  
    // Reject All → swap to educational dark-pattern demo text
    rejectBtn.addEventListener("click", () => {
      msgEl.textContent =
        "Notice how the “Reject All” option disappears? This is a demonstration showing how some sites coerce you into clicking “Accept All.” " +
        "By forcing you to accept before proceeding, they manipulate consent. To continue, you must now click “Accept All.”";
      rejectBtn.style.display = "none";
      // leave acceptBtn visible so they can consciously click it
    });
  
    // Reset (dev/testing) clears the flag
    resetBtn?.addEventListener("click", () => {
      localStorage.removeItem("cookiesAccepted");
      location.reload();
    });
  
    // Show reset only in dev mode
    document.body.classList.add("dev-mode");
  });
  

// ───────── Learn-More Toggle Typewriter ─────────
document.addEventListener("DOMContentLoaded", function () {
    const btn    = document.getElementById("learn-more-btn");
    const info   = document.getElementById("cookie-info");
    if (!btn || !info) return;

    btn.addEventListener("click", e => {
        e.preventDefault();
        info.classList.toggle("hidden");

        const headEl = document.getElementById("typewriter-heading");
        const paraEl = document.getElementById("typewriter-text");
        if (!headEl || !paraEl) return;

        headEl.textContent = "";
        paraEl.textContent = "";

        const headingText = "Did You Know You Accepted Cookies?";
        const paraText    = "By clicking 'Accept,' you’ve allowed this website to store your data.";

        function writer(el, txt, speed, cb) {
            let i = 0;
            (function step() {
                if (i < txt.length) {
                    el.textContent += txt.charAt(i++);
                    setTimeout(step, speed);
                } else if (cb) cb();
            })();
        }

        writer(headEl, headingText, 50, () => {
            writer(paraEl, paraText, 50);
        });
    });
});

// ───────── Quiz Slider + Timer + Progress ─────────
document.addEventListener("DOMContentLoaded", function() {
    const slides   = Array.from(document.querySelectorAll('.slide'));
    const prevBtn  = document.getElementById('prev-btn');
    const nextBtn  = document.getElementById('next-btn');
    const form     = document.getElementById('quiz-form');
    const timerEl  = document.getElementById('time');
    const progText = document.getElementById('progress-text');
    const progBar  = document.getElementById('progress-bar');

    if (!slides.length || !form) return; // not on quiz page

    const timePerQ = 30;  // seconds
    let   current = 0;
    let   timeLeft, timerInt;

    function startTimer() {
        clearInterval(timerInt);
        timeLeft = timePerQ;
        timerEl.textContent = timeLeft;
        timerInt = setInterval(() => {
            timeLeft--;
            timerEl.textContent = timeLeft;
            if (timeLeft <= 0) {
                clearInterval(timerInt);
                if (current === slides.length - 1) {
                    form.submit();
                } else {
                    goToSlide(current + 1);
                }
            }
        }, 1000);
    }

    function updateProgress() {
        const total = slides.length;
        progText.textContent = `Question ${current + 1} of ${total}`;
        progBar.style.width  = `${((current + 1)/total)*100}%`;
    }

    function showSlide(n) {
        slides.forEach((s,i) => s.classList.toggle('active', i === n));
        prevBtn.disabled = (n === 0);
        nextBtn.textContent = (n === slides.length - 1) ? 'Submit' : 'Next';
        current = n;
        updateProgress();
        startTimer();
    }

    function goToSlide(n) {
        if (n < 0 || n >= slides.length) return;
        showSlide(n);
    }

    prevBtn.addEventListener('click', () => goToSlide(current - 1));
    nextBtn.addEventListener('click', () => {
        if (current === slides.length - 1) {
            clearInterval(timerInt);
            form.submit();
        } else {
            goToSlide(current + 1);
        }
    });

    // initialize
    showSlide(0);
});
