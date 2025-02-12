<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "FYP"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_username = $_POST['username'];
    $user_password = $_POST['password'];

    // Hash the password for security
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    // Insert into the database
    $sql = "INSERT INTO users (username, password, score) VALUES ('$user_username', '$hashed_password', 0)";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! <a href='login.html'>Login</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
