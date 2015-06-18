<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use CotaPreco\Captcha\CaptchaInterface;
use CotaPreco\Captcha\Solver\DeathByCaptcha\Exception\ServiceTemporarilyOverloadedException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Message\RequestInterface;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class OnServiceUnavailableTest extends TestCase
{
    /**
     * @test
     */
    public function requestSolutionForCaptcha()
    {
        $this->setExpectedException(ServiceTemporarilyOverloadedException::class);

        /* @var RequestInterface $request */
        $request = $this->getMock(RequestInterface::class);

        /* @var \PHPUnit_Framework_MockObject_MockObject|DeathByCaptchaInterface $deathByCaptcha */
        $deathByCaptcha = $this->getMock(DeathByCaptchaInterface::class);

        $deathByCaptcha->expects($this->once())
            ->method('requestSolutionForCaptcha')
            ->with($this->isInstanceOf(CaptchaInterface::class))
            ->willThrowException(new ServerException('', $request));

        /* @var CaptchaInterface $captcha */
        $captcha = $this->getMock(CaptchaInterface::class);

        $onServiceUnavailable = new OnServiceUnavailable($deathByCaptcha);

        $onServiceUnavailable->requestSolutionForCaptcha($captcha);
    }
}
