<?php

namespace CotaPreco\Captcha;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
final class Base64Captcha implements CaptchaInterface
{
    /**
     * @var string
     */
    private $base64;

    /**
     * @param string $base64
     */
    private function __construct($base64)
    {
        $this->base64 = (string) $base64;
    }

    /**
     * @param  string $base64
     * @return self
     */
    public static function fromString($base64)
    {
        return new self($base64);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->base64;
    }
}
