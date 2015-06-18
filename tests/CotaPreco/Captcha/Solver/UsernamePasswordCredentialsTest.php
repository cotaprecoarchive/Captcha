<?php

namespace CotaPreco\Captcha\Solver;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class UsernamePasswordCredentialsTest extends TestCase
{
    /**
     * @var UsernamePasswordCredentials
     */
    private $credentials;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->credentials = UsernamePasswordCredentials::fromUsernameAndPassword(
            'user',
            'supersecret'
        );
    }

    /**
     * @test
     */
    public function getUsername()
    {
        $this->assertEquals('user', $this->credentials->getUsername());
    }

    /**
     * @test
     */
    public function getPassword()
    {
        $this->assertEquals('supersecret', $this->credentials->getPassword());
    }
}
