<?php
$conn = new mysqli("localhost", "root", "", "fyp");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// 4 multiple choices 
$sql = "SELECT id, question, option_a, option_b, option_c, option_d FROM quiz_questions ORDER BY RAND() LIMIT 5";
$result = $conn->query($sql);

$questions = [];

while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

echo json_encode($questions);
?>
