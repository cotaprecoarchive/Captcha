<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use CotaPreco\Captcha\CaptchaInterface;
use CotaPreco\Captcha\CaptchaSolutionInterface;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class AbstractDeathByCaptchaWrapperTest extends TestCase
{
    /**
     * @test
     */
    public function requestSolutionForCaptcha()
    {
        /* @var DeathByCaptchaInterface|\PHPUnit_Framework_MockObject_MockObject $deathByCaptcha */
        $deathByCaptcha = $this->getMock(DeathByCaptchaInterface::class);

        $deathByCaptcha->expects($this->once())
            ->method('requestSolutionForCaptcha')
            ->with($this->isInstanceOf(CaptchaInterface::class));

        /* @var DeathByCaptchaInterface $wrapper */
        $wrapper = $this->getMockForAbstractClass(AbstractDeathByCaptchaWrapper::class, [
            $deathByCaptcha
        ]);

        /* @var CaptchaInterface $captcha */
        $captcha = $this->getMock(CaptchaInterface::class);

        $wrapper->requestSolutionForCaptcha($captcha);
    }

    /**
     * @test
     */
    public function incorrectlySolved()
    {
        /* @var DeathByCaptchaInterface|\PHPUnit_Framework_MockObject_MockObject $deathByCaptcha */
        $deathByCaptcha = $this->getMock(DeathByCaptchaInterface::class);

        $deathByCaptcha->expects($this->once())
            ->method('incorrectlySolved')
            ->with($this->isInstanceOf(CaptchaSolutionInterface::class));

        /* @var DeathByCaptchaInterface $wrapper */
        $wrapper = $this->getMockForAbstractClass(AbstractDeathByCaptchaWrapper::class, [
            $deathByCaptcha
        ]);

        /* @var CaptchaSolutionInterface $solution */
        $solution = $this->getMock(CaptchaSolutionInterface::class);

        $wrapper->incorrectlySolved($solution);
    }
}
