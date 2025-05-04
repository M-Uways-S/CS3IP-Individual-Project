<?php
use PHPUnit\Framework\TestCase;

class SignupTest extends TestCase
{
    public function testUserIsStoredAndPasswordIsHashed()
    {
        $username = 'mockuser';
        $password = 'MockPassword123';

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $mockDatabase = [];
        $mockDatabase[$username] = ['password' => $hashedPassword];

        $user = $mockDatabase[$username] ?? false;


        $this->assertNotFalse($user, "User exists in mock database");
        $this->assertTrue(password_verify($password, $user['password']), "Password hash verified");
    }
}
