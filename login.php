<?php
session_start(); // Start the session

// If the user is already logged in, redirect to the home page
if (isset($_SESSION['username'])) {
    header("Location: home.html"); // Redirect to home page
    exit();
}

$servername = "localhost";
$username = "root"; // Default username for WAMP
$password = ""; // Default password for WAMP
$dbname = "FYP"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the user input from the form
    $user_username = $_POST['username'];
    $user_password = $_POST['password'];

    // Prepare and bind SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $user_username); // 's' means a string parameter

    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // Fetch user data
        $user_data = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($user_password, $user_data['password'])) {
            // If correct, start a session
            $_SESSION['username'] = $user_username;
            $_SESSION['score'] = $user_data['score']; // Optionally store the score in session
            header("Location: home.html"); // Redirect to home page
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }

    $stmt->close();
}

$conn->close();
?>
