<?php
session_start(); // Start the session

// thsi checks if the user is logged in
if (isset($_SESSION['user_id'])) {
    echo json_encode(['logged_in' => true, 'user_id' => $_SESSION['user_id']]);
} else {
    echo json_encode(['logged_in' => false]);
}
?>
