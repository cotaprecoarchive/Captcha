<?php

namespace CotaPreco\Captcha;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
abstract class CaptchaSolution implements CaptchaSolutionInterface
{
    /**
     * @var string
     */
    private $solution;

    /**
     * @param string $solution
     */
    public function __construct($solution)
    {
        $this->solution = (string) $solution;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->solution;
    }
}
