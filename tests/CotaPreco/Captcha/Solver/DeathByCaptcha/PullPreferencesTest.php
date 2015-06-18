<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class PullPreferencesTest extends TestCase
{
    /**
     * @var PullPreferences
     */
    private $preferences;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->preferences = PullPreferences::fromRecommendedPreferences();
    }

    /**
     * @test
     */
    public function fromPreferences()
    {
        $preferences = PullPreferences::fromPreferences(10, 10);

        $this->assertEquals(10, $preferences->getInterval());
        $this->assertEquals(10, $preferences->getMaxAttempts());
    }

    /**
     * @test
     */
    public function getInterval()
    {
        $this->assertEquals(5, $this->preferences->getInterval());
    }

    /**
     * @test
     */
    public function getMaxAttempts()
    {
        $this->assertEquals(5, $this->preferences->getMaxAttempts());
    }
}
