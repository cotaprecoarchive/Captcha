<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use CotaPreco\Captcha\Solver\UsernamePasswordCredentials;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class DeathByCaptchaFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function createWithPreferences()
    {
        $deathByCaptcha = DeathByCaptchaFactory::createWithPreferences(
            UsernamePasswordCredentials::fromUsernameAndPassword('foo', 'bar'),
            PullPreferences::fromPreferences(10, 10)
        );

        $this->assertInstanceOf(DeathByCaptchaInterface::class, $deathByCaptcha);
    }

    /**
     * @test
     */
    public function createWithDefaultPreferences()
    {
        $deathByCaptcha = DeathByCaptchaFactory::createWithDefaultPreferences(
            UsernamePasswordCredentials::fromUsernameAndPassword('foo', 'bar')
        );

        $this->assertInstanceOf(DeathByCaptchaInterface::class, $deathByCaptcha);
    }
}
