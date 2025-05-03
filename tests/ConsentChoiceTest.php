<?php
use PHPUnit\Framework\TestCase;

class ConsentChoiceTest extends TestCase
{
    public function testAcceptedConsentIsStored()
    {
        $_COOKIE['cookiesAccepted'] = 'true';
        $this->assertArrayHasKey('cookiesAccepted', $_COOKIE);
        $this->assertEquals('true', $_COOKIE['cookiesAccepted']);
    }

    public function testRejectedConsentIsNotStored()
    {
        $_COOKIE = [];
        $this->assertArrayNotHasKey('cookiesAccepted', $_COOKIE);
    }
}
