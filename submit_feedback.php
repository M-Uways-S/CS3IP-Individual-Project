<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "FYP";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$feedback_text = $conn->real_escape_string($_POST['feedback_text']);

$sql = "INSERT INTO feedbacks (feedback_text) VALUES ('$feedback_text')";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Thank you for your feedback!'); window.location.href='home.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
