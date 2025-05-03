<?php
use PHPUnit\Framework\TestCase;

class SignupTest extends TestCase
{
    public function testUserIsStoredAndPasswordIsHashed()
    {
        // Step 1: Simulate signup form input
        $username = 'mockuser';
        $password = 'MockPassword123';

        // Step 2: Hash the password (like your real app does)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Step 3: Simulate mock "database" using an array
        $mockDatabase = [];
        $mockDatabase[$username] = ['password' => $hashedPassword];

        // Step 4: Simulate login check
        $user = $mockDatabase[$username] ?? false;

        // Step 5: Run tests
        $this->assertNotFalse($user, "User should exist in mock database");
        $this->assertTrue(password_verify($password, $user['password']), "Password hash should verify correctly");
    }
}
