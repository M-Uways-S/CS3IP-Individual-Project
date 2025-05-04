<?php
use PHPUnit\Framework\TestCase;

class FeedbackTest extends TestCase
{
    private $pdo;
    private $testMessage = "Anonymous test feedback";

    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=fyp', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function testAnonymousFeedbackStoredCorrectly()
    {
        $stmt = $this->pdo->prepare("INSERT INTO feedbacks (feedback_text) VALUES (?)");
        $stmt->execute([$this->testMessage]);

        $stmt = $this->pdo->prepare("SELECT * FROM feedbacks WHERE feedback_text = ? ORDER BY id DESC LIMIT 1");
        $stmt->execute([$this->testMessage]);
        $feedback = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotFalse($feedback);
        $this->assertEquals($this->testMessage, $feedback['feedback_text']);
    }
}
