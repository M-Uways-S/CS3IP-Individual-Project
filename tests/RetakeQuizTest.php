<?php
use PHPUnit\Framework\TestCase;

class RetakeQuizTest extends TestCase
{
    private $pdo;
    private $username = 'retake_test_user';

    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=fyp', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $this->pdo->prepare("INSERT IGNORE INTO users (username, password, score) VALUES (?, ?, ?)");
        $stmt->execute([$this->username, password_hash('test123', PASSWORD_DEFAULT), 4]);
    }

    public function testRetakeScoreUpdatesCorrectly()
    {
        // this is new quiz score that should take the old quiz scores place
        $newScore = 9;

        $stmt = $this->pdo->prepare("UPDATE users SET score = ? WHERE username = ?");
        $stmt->execute([$newScore, $this->username]);

        $stmt = $this->pdo->prepare("SELECT score FROM users WHERE username = ?");
        $stmt->execute([$this->username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotFalse($user);
        $this->assertEquals($newScore, $user['score']);
    }
}
