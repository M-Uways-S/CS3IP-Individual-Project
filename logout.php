<?php
session_start();
session_destroy();
setcookie("cookiesAccepted", "", time() - 3600, "/"); // Expire the cookie on logout

// Clear the local storage for cookies preference and redirect to the homepage
echo "<script>
        localStorage.removeItem('cookiesAccepted');
        window.location.href = 'home.php'; 
        </script>";
exit();
?>
