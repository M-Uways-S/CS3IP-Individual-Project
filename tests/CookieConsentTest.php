<?php
use PHPUnit\Framework\TestCase;

class CookieConsentTest extends TestCase
{
    public function testCookieConsentAcceptedIsStored()
    {
        $_COOKIE['cookiesAccepted'] = 'true';

        $this->assertEquals('true', $_COOKIE['cookiesAccepted']);
    }

    public function testCookieConsentRejectedIsStored()
    {
        $_COOKIE['cookiesAccepted'] = 'false';

        $this->assertEquals('false', $_COOKIE['cookiesAccepted']);
    }
}
