<?php

/*
 * Copyright (c) 2015 Cota Preço
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

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
