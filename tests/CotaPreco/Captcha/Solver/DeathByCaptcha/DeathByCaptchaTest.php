<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use CotaPreco\Captcha\Base64Captcha;
use CotaPreco\Captcha\CaptchaSolutionInterface;
use CotaPreco\Captcha\Solver\UsernamePasswordCredentials;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Subscriber\Mock;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class DeathByCaptchaTest extends TestCase
{
    /**
     * @var UsernamePasswordCredentials
     */
    private $credentials;

    /**
     * @var Base64Captcha
     */
    private $captcha;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->credentials = UsernamePasswordCredentials::fromUsernameAndPassword(
            'usr',
            'pswd'
        );

        $this->captcha = Base64Captcha::fromString('');
    }

    /**
     * @test
     */
    public function requestSolutionForCaptcha()
    {
        $this->setExpectedException(ServerException::class);

        $mock = new Mock([
            new Response(503, [])
        ]);

        $httpClient = new Client();

        $httpClient->getEmitter()->attach($mock);

        $deathByCaptcha = new DeathByCaptcha($this->credentials, null, $httpClient);

        $deathByCaptcha->requestSolutionForCaptcha($this->captcha);
    }

    /**
     * @test
     */
    public function requestSolutionForCaptchaReturnsFalse()
    {
        $mock = new Mock([
            new Response(200, [], Stream::factory(json_encode([])))
        ]);

        $httpClient = new Client();

        $httpClient->getEmitter()->attach($mock);

        $deathByCaptcha = new DeathByCaptcha($this->credentials, null, $httpClient);

        $this->assertFalse($deathByCaptcha->requestSolutionForCaptcha($this->captcha));
    }

    /**
     * @test
     */
    public function pullSolutionForReturnsFalse()
    {
        $mock = new Mock([
            new Response(200, [], Stream::factory(json_encode([
                'captcha' => uniqid('', true),
                'text' => ''
            ]))),
            new Response(200, [], Stream::factory(json_encode([
                'captcha' => uniqid('', true),
                'text' => ''
            ]))),
            new Response(200, [], Stream::factory(json_encode([
                'captcha' => uniqid('', true),
                'text' => ''
            ])))
        ]);

        $httpClient = new Client();

        $httpClient->getEmitter()->attach($mock);

        $deathByCaptcha = new DeathByCaptcha(
            $this->credentials,
            PullPreferences::fromPreferences(0, 1),
            $httpClient
        );

        $this->assertFalse($deathByCaptcha->requestSolutionForCaptcha($this->captcha));
    }

    /**
     * @test
     */
    public function pullSolutionFor()
    {
        $captchaId = uniqid('', true);

        $mock = new Mock([
            new Response(200, [], Stream::factory(json_encode([
                'captcha' => $captchaId
            ]))),
            new Response(200, [], Stream::factory(json_encode([
                'captcha' => $captchaId,
                'text' => 'lorem'
            ])))
        ]);

        $httpClient = new Client();

        $httpClient->getEmitter()->attach($mock);

        $deathByCaptcha = new DeathByCaptcha($this->credentials, null, $httpClient);

        $solution = $deathByCaptcha->requestSolutionForCaptcha($this->captcha);

        $this->assertInstanceOf(DeathByCaptchaCaptchaSolution::class, $solution);
    }

    /**
     * @test
     */
    public function incorrectlySolvedReturnsFalse()
    {
        $deathByCaptcha = new DeathByCaptcha($this->credentials);

        /* @var CaptchaSolutionInterface $solution */
        $solution = $this->getMock(CaptchaSolutionInterface::class);

        $deathByCaptcha->incorrectlySolved($solution);
    }

    /**
     * @test
     */
    public function incorrectlySolved()
    {
        $mock = new Mock([
            new Response(200, [])
        ]);

        $httpClient = new Client();

        $httpClient->getEmitter()->attach($mock);

        $deathByCaptcha = new DeathByCaptcha($this->credentials, null, $httpClient);

        $solution = new DeathByCaptchaCaptchaSolution(
            'lorem',
            '123456'
        );

        $deathByCaptcha->incorrectlySolved($solution);
    }
}
