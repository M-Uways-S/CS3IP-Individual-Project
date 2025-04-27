<?php
session_start();
$username = $_SESSION['username'] ?? 'guest';
session_destroy();
setcookie("cookiesAccepted", "", time() - 3600, "/"); // Expires the cookie on logout so the banner can appear for new user

// Clear the local storage for cookies preference AND learn progress so quiz stays mandatory
echo "<script>
        localStorage.removeItem('cookiesAccepted');
        localStorage.removeItem('learnVisited_$username');
        window.location.href = 'home.php'; 
        </script>";
exit();
?>
