<?php

namespace CotaPreco\Captcha;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class Base64CaptchaTest extends TestCase
{
    /**
     * @test
     */
    public function fromString()
    {
        $captcha = Base64Captcha::fromString('');

        $this->assertInstanceOf(CaptchaInterface::class, $captcha);
    }

    /**
     * @test
     */
    public function toString()
    {
        $base64 = base64_encode(uniqid('', true));

        $captcha = Base64Captcha::fromString($base64);

        $this->assertSame($base64, (string) $captcha);
    }
}
