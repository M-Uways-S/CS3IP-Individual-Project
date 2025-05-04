<?php
use PHPUnit\Framework\TestCase;

class LeaderboardTest extends TestCase
{
    private $pdo;
    private $users = [
        ['username' => 'leader_user1', 'password' => 'test123', 'score' => 5],
        ['username' => 'leader_user2', 'password' => 'test123', 'score' => 9],
        ['username' => 'leader_user3', 'password' => 'test123', 'score' => 7],
    ];

    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=fyp', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        foreach ($this->users as $user) {
            $stmt = $this->pdo->prepare("INSERT IGNORE INTO users (username, password, score) VALUES (?, ?, ?)");
            $stmt->execute([
                $user['username'],
                password_hash($user['password'], PASSWORD_DEFAULT),
                $user['score']
            ]);
        }
    }
    public function testLeaderboardOrder()
    {
        $usernames = array_map(fn($u) => $this->pdo->quote($u['username']), $this->users);
        $inClause = implode(',', $usernames);

        $stmt = $this->pdo->query("SELECT username FROM users WHERE username IN ($inClause) ORDER BY score DESC");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $expected = ['leader_user2', 'leader_user3', 'leader_user1'];
        $actual = array_column($results, 'username');

        $this->assertEquals($expected, $actual);
    }
}
