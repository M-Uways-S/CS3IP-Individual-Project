<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    private $mockDatabase;

    protected function setUp(): void
    {
        $password = 'CorrectPass123';
        $this->mockDatabase = [
            'testuser' => ['password' => password_hash($password, PASSWORD_DEFAULT)]
        ];
    }

    public function testLoginWithValidCredentials()
    {
        $username = 'testuser';
        $enteredPassword = 'CorrectPass123';
        $user = $this->mockDatabase[$username] ?? false;

        $this->assertNotFalse($user, "User should exist in mock database");
        $this->assertTrue(password_verify($enteredPassword, $user['password']), "Password should match");
    }

    public function testLoginWithInvalidCredentials()
    {
        $username = 'testuser';
        $enteredPassword = 'WrongPass!';
        $user = $this->mockDatabase[$username] ?? false;

        $this->assertNotFalse($user, "User should exist in mock database");
        $this->assertFalse(password_verify($enteredPassword, $user['password']), "Password should not match");
    }
}
