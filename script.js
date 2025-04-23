// script.js
document.addEventListener("DOMContentLoaded", () => {
    const overlay    = document.getElementById("overlay");
    const banner     = document.getElementById("cookie-consent");
    const contentDiv = banner.querySelector(".cookie-consent-content");

    const acceptBtn  = document.getElementById("cookie-accept");
    const rejectBtn  = document.getElementById("cookie-reject");
    const manageBtn  = document.getElementById("cookie-manage-btn");

    // Helper to hide both overlay & banner
    function completeConsent() {
        overlay.classList.add("hidden");
        banner.classList.add("hidden");
    }

    // Handler for Accept All (works in both modes)
    function handleAccept() {
        localStorage.setItem("cookiesAccepted", "true");
        completeConsent();
        // init analytics etc...
    }

    // Render the “reject” state: shake + test message + lone Accept button
    function renderRejectState() {
        banner.classList.add("shake");
        setTimeout(() => banner.classList.remove("shake"), 500);

        contentDiv.innerHTML = `
            <p>
                This is a test to show users an example of how users are coerced
                into clicking “Accept All.”
            </p>
            <div class="cookie-buttons">
                <button id="cookie-accept-alone" class="btn-primary">
                    Accept All to Continue
                </button>
            </div>
        `;
        // Bind the lone Accept
        document
          .getElementById("cookie-accept-alone")
          .addEventListener("click", handleAccept);
    }

    // Initial check
    const choice = localStorage.getItem("cookiesAccepted");
    if (choice === "true") {
        // Already accepted → nothing to do
        completeConsent();
    } else {
        // Either never seen banner (choice===null) or previously rejected (choice==="false")
        overlay.classList.remove("hidden");
        banner.classList.remove("hidden");

        if (choice === "false") {
            // They had rejected before → show the test message immediately
            renderRejectState();
        } else {
            // First‐time visitor → bind the normal Accept/Reject/Manage flows
            acceptBtn.addEventListener("click", handleAccept);
            rejectBtn.addEventListener("click", () => {
                localStorage.setItem("cookiesAccepted", "false");
                renderRejectState();
                // keep overlay/banner visible until they accept
                overlay.classList.remove("hidden");
                banner.classList.remove("hidden");
            });
            manageBtn.addEventListener("click", () => {
                alert("Here would open cookie settings.");
            });
        }
    }


        // Reset Cookies (admin/testing)
        const resetBtn = document.getElementById("cookie-reset-btn");
        resetBtn.addEventListener("click", () => {
            localStorage.removeItem("cookiesAccepted");
            location.reload();
        });
    
});
