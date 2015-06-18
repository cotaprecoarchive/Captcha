<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class DeathByCaptchaCaptchaSolutionTest extends TestCase
{
    /**
     * @var DeathByCaptchaCaptchaSolution
     */
    private $solution;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->solution = new DeathByCaptchaCaptchaSolution('FOOBAR', '1234');
    }

    /**
     * @test
     */
    public function getSolution()
    {
        $this->assertEquals('FOOBAR', (string) $this->solution);
    }

    /**
     * @test
     */
    public function getCaptchaId()
    {
        $this->assertSame('1234', $this->solution->getCaptchaId());
    }
}
