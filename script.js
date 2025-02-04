document.addEventListener("DOMContentLoaded", function () {
    const cookiePopup = document.getElementById("cookie-popup");
    const acceptBtn = document.getElementById("accept-btn");
    const declineBtn = document.getElementById("decline-btn");

    // Show the popup when the page loads
    cookiePopup.classList.remove("hidden");

    // Handle Accept button click
    acceptBtn.addEventListener("click", function () {
        localStorage.setItem("cookiesAccepted", "true");
        cookiePopup.classList.add("hidden");
    });

    // Handle Decline button click
    declineBtn.addEventListener("click", function () {
        localStorage.setItem("cookiesAccepted", "false");
        cookiePopup.classList.add("hidden");
    });

    // Check if cookies were already accepted
    if (localStorage.getItem("cookiesAccepted") === "true" || localStorage.getItem("cookiesAccepted") === "false") {
        cookiePopup.classList.add("hidden");
    }
});
