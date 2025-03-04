<?php
session_start(); // Start the session

// Check if the user is logged in (simplified check using session)
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User is not logged in']);
    exit;
}

// Get the quiz answers from the frontend
$data = json_decode(file_get_contents('php://input'), true);

// Check if we received data
if (!$data) {
    echo json_encode(['error' => 'No data received']);
    exit;
}

// Assume we have a function to check answers and calculate score
$score = 0;
foreach ($data as $questionId => $answer) {
    // Here, you should validate the answers with your database or predefined answers
    if (validateAnswer($questionId, $answer)) {
        $score++;
    }
}

// You can save the score in the database if needed
// For now, we'll just return the score
echo json_encode(['score' => $score]);

// Simple function to validate the answers (for now, just a dummy function)
function validateAnswer($questionId, $answer) {
    // Validate against stored answers, this is just a placeholder
    $correctAnswers = [
        1 => 'C', // Example correct answers
        2 => 'B'
    ];
    
    return isset($correctAnswers[$questionId]) && $correctAnswers[$questionId] === $answer;
}
?>
