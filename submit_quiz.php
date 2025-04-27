<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User is not logged in']);
    exit;
}

// this gets the quiz answers from the frontend
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['error' => 'No data received']);
    exit;
}

$score = 0;
foreach ($data as $questionId => $answer) {
    // checks if answers are correct against database 
    if (validateAnswer($questionId, $answer)) {
        $score++;
    }
}

echo json_encode(['score' => $score]);

function validateAnswer($questionId, $answer) {
    $correctAnswers = [
        1 => 'C',
        2 => 'B'
    ];
    
    return isset($correctAnswers[$questionId]) && $correctAnswers[$questionId] === $answer;
}
?>
