// Cookie consent banner
document.addEventListener("DOMContentLoaded", () => {
    const overlay   = document.getElementById("overlay");
    const banner    = document.getElementById("cookie-consent");
    if (!banner) return;
  
    const acceptBtn = document.getElementById("cookie-accept");
    const rejectBtn = document.getElementById("cookie-reject");
    const resetBtn  = document.getElementById("cookie-reset-btn");
    const msgEl     = banner.querySelector(".cookie-consent-content p");
  
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
  
    if (localStorage.getItem("cookiesAccepted") !== "true") {
      showAll();
    }
  
    acceptBtn.addEventListener("click", () => {
      localStorage.setItem("cookiesAccepted", "true");
      hideAll();
    });
  
    rejectBtn.addEventListener("click", () => {
      msgEl.textContent =
        "Notice how the “Reject All” option disappears? This is a demonstration showing how some sites coerce you into clicking “Accept All.” " +
        "By forcing you to accept before proceeding, they manipulate consent. To continue, you must now click “Accept All.”";
      rejectBtn.style.display = "none";
    });
  
    resetBtn?.addEventListener("click", () => {
      localStorage.removeItem("cookiesAccepted");
      location.reload();
    });
  
    document.body.classList.add("dev-mode");
  });
  
  
  // this is the quiz slider + timer + progress bar for the quiz page 
  document.addEventListener("DOMContentLoaded", () => {
    const slides   = Array.from(document.querySelectorAll('.slide'));
    const prevBtn  = document.getElementById('prev-btn');
    const nextBtn  = document.getElementById('next-btn');
    const form     = document.getElementById('quiz-form');
    const timerEl  = document.getElementById('time');
    const progText = document.getElementById('progress-text');
    const progBar  = document.getElementById('progress-bar');
  
    if (!slides.length || !form) return;
  
    const timePerQ = 30;
    let current = 0, timeLeft, timerInt;
  
    function startTimer() {
      clearInterval(timerInt);
      timeLeft = timePerQ;
      timerEl.textContent = timeLeft;
      timerInt = setInterval(() => {
        timeLeft--;
        timerEl.textContent = timeLeft;
        if (timeLeft <= 0) {
          clearInterval(timerInt);
          if (current === slides.length - 1) form.submit();
          else goToSlide(current + 1);
        }
      }, 1000);
    }
  
    function updateProgress() {
      const total = slides.length;
      progText.textContent = `Question ${current + 1} of ${total}`;
      progBar.style.width  = `${((current + 1) / total) * 100}%`;
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
  
    showSlide(0);
  });
  
  // cookie simulator on learn page
  document.addEventListener("DOMContentLoaded", () => {
    const simName = document.getElementById("cookie-name");
    const simVal  = document.getElementById("cookie-value");
    const out     = document.getElementById("cookie-output");
    if (!simName || !simVal || !out) return;
  
    document.getElementById("set-cookie").addEventListener("click", () => {
      const name  = encodeURIComponent(simName.value);
      const value = encodeURIComponent(simVal.value);
      document.cookie = `${name}=${value}; path=/`;
      out.textContent = `Set: ${simName.value}=${simVal.value}`;
    });
  
    document.getElementById("view-cookies").addEventListener("click", () => {
      out.textContent = document.cookie || "No cookies set.";
    });
  
    document.getElementById("delete-cookie").addEventListener("click", () => {
      const name = encodeURIComponent(simName.value);
      document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`;
      out.textContent = `Deleted cookie: ${simName.value}`;
    });
  });
  
// drop down menu + drop down menu progress tablets with ticks + locked quiz feature (till reviewed all content on learn)
document.addEventListener("DOMContentLoaded", () => {
    const body       = document.body;
    const username   = body.dataset.user || 'guest';
    const storageKey = `learnVisited_${username}`;
    const steps      = document.querySelectorAll(".progress-step");
    const accordions = document.querySelectorAll(".accordion");
    const quizBtn    = document.getElementById("take-quiz-btn");
    let visited = new Set(JSON.parse(localStorage.getItem(storageKey)) || []);
    function renderProgress() {
      steps.forEach(el => {
        el.classList.toggle("completed", visited.has(el.dataset.step));
      });
      if (visited.size === steps.length) {
        quizBtn.classList.remove("disabled");
        quizBtn.href = "quiz.php";
      } else {
        quizBtn.classList.add("disabled");
        quizBtn.href = "#";
      }
    }
    accordions.forEach(acc => {
      const btn   = acc.querySelector(".accordion-toggle");
      const panel = acc.querySelector(".accordion-panel");
      const step  = acc.id.replace("lesson", "");
  
      btn.addEventListener("click", () => {
        btn.classList.toggle("active");
        panel.classList.toggle("open");
  
        if (!visited.has(step)) {
          visited.add(step);
          localStorage.setItem(storageKey, JSON.stringify([...visited]));
          renderProgress();
        }
      });
    });
    // clear this user’s progress on logout
    document
    .querySelector('.nav-auth a[href="logout.php"]')
    ?.addEventListener('click', () => {
      localStorage.removeItem(`learnVisited_${username}`);
    });
  
    renderProgress();
  });
  
  
  // reset consent demo
  document.addEventListener("DOMContentLoaded", () => {
    const resetConsentBtn = document.getElementById("reset-consent-btn");
    const cookieOutput    = document.getElementById("cookie-output");
    if (!resetConsentBtn) return;
  
    resetConsentBtn.addEventListener("click", () => {
      localStorage.removeItem("cookiesAccepted");
  
      // re-show same cookie sent banner 
      const banner  = document.getElementById("cookie-consent");
      const overlay = document.getElementById("overlay");
      banner.classList.remove("hidden");
      overlay.classList.remove("hidden");
      document.body.style.overflow = "hidden";
  
      if (cookieOutput) {
        cookieOutput.textContent = "Consent reset! Observe how you must Accept All again.";
      }
    });
  });

  // locked quiz on nav bar too so users have to do learn section first
document.addEventListener("DOMContentLoaded", () => {

    const user       = document.body.dataset.user || "guest";
    const storageKey = `learnVisited_${user}`;
    const visited    = JSON.parse(localStorage.getItem(storageKey) || "[]");
  

    const quizNav = document.querySelector('.nav-main a[href="quiz.php"]');
    if (!quizNav) return;
  
    // if they haven’t finished all 4 learn sections, block button
    if (visited.length < 4) {
      quizNav.addEventListener("click", (e) => {
        e.preventDefault();
        alert("Please review all four lessons before taking the quiz.");
        window.location.href = "learn.php";
      });
    }
  });
  