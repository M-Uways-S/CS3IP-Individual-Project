<?php
session_start();
$username = $_SESSION['username'] ?? 'guest'; // capture username before destroying session
session_destroy();
setcookie("cookiesAccepted", "", time() - 3600, "/"); // Expire the cookie on logout

// Clear the local storage for cookies preference AND learn progress
echo "<script>
        localStorage.removeItem('cookiesAccepted');
        localStorage.removeItem('learnVisited_$username');
        window.location.href = 'home.php'; 
        </script>";
exit();
?>
