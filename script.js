document.addEventListener("DOMContentLoaded", function () {
    const cookiePopup = document.getElementById("cookie-popup");
    const overlay = document.getElementById("overlay");
    const acceptBtn = document.getElementById("accept-btn");
    const declineBtn = document.getElementById("decline-btn");
    const cookieMessage = document.getElementById("cookie-message");
    const resetBtn = document.getElementById("reset-cookies");

    // Create Refresh button dynamically
    const refreshBtn = document.createElement("button");
    refreshBtn.innerText = "Refresh";
    refreshBtn.id = "refresh-btn";
    refreshBtn.style.display = "none";
    refreshBtn.style.background = "#ff9800";
    refreshBtn.style.color = "white";
    refreshBtn.style.padding = "8px 15px";
    refreshBtn.style.border = "none";
    refreshBtn.style.cursor = "pointer";
    refreshBtn.style.borderRadius = "5px";

    // Append the Refresh button next to the message
    cookiePopup.appendChild(refreshBtn);

    // Show popup and overlay until accepted
    if (localStorage.getItem("cookiesAccepted") !== "true") {
        cookiePopup.classList.remove("hidden");
        overlay.style.display = "block"; 
        document.body.style.overflow = "hidden"; 
    } else {
        overlay.style.display = "none"; 
        document.body.style.overflow = "auto"; 
    }

    // Accept button
    acceptBtn.addEventListener("click", function () {
        localStorage.setItem("cookiesAccepted", "true");
        cookiePopup.classList.add("hidden");
        overlay.style.display = "none"; 
        document.body.style.overflow = "auto"; 
    });

    // Decline button
    declineBtn.addEventListener("click", function () {
        cookieMessage.innerHTML = "You must accept cookies to use this site. Please refresh to accept.";
        acceptBtn.style.display = "none";
        declineBtn.style.display = "none";
        refreshBtn.style.display = "block";
    });

    // Refresh button (reloads the page)
    refreshBtn.addEventListener("click", function () {
        location.reload();
    });

    // Reset Cookies button (For Development)
    resetBtn.addEventListener("click", function () {
        localStorage.removeItem("cookiesAccepted");
        location.reload(); // Reload page to see cookie popup again
    });

    // Show Reset Button only for development mode
    document.body.classList.add("dev-mode");
});
