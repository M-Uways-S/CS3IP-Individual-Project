<?php
use PHPUnit\Framework\TestCase;

class StoreScoreTest extends TestCase
{
    private $pdo;
    private $username = 'store_test_user';
    private $score = 8;

    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=fyp', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $this->pdo->prepare("INSERT IGNORE INTO users (username, password, score) VALUES (?, ?, ?)");
        $stmt->execute([$this->username, password_hash('test123', PASSWORD_DEFAULT), 0]);
    }

    public function testScoreStoredInUsersTable()
    {
        $stmt = $this->pdo->prepare("UPDATE users SET score = ? WHERE username = ?");
        $stmt->execute([$this->score, $this->username]);

        $stmt = $this->pdo->prepare("SELECT score FROM users WHERE username = ?");
        $stmt->execute([$this->username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotFalse($result);
        $this->assertEquals($this->score, $result['score']);
    }

}
