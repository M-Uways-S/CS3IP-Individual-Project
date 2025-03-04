<?php
$conn = new mysqli("localhost", "root", "", "fyp");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);
$score = 0;

foreach ($data as $questionId => $userAnswer) {
    $sql = "SELECT correct_option FROM quiz_questions WHERE id = $questionId";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    if ($row["correct_option"] === $userAnswer) {
        $score++;
    }
}

$username = "test_user"; // Replace with logged-in user
$sql = "INSERT INTO quiz_scores (username, score) VALUES ('$username', $score)";
$conn->query($sql);

echo json_encode(["score" => $score]);
?>
