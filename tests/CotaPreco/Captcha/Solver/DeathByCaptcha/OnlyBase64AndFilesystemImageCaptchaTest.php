<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use CotaPreco\Captcha\Base64Captcha;
use CotaPreco\Captcha\CaptchaInterface;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class OnlyBase64AndFilesystemImageCaptchaTest extends TestCase
{
    /**
     * @test
     */
    public function requestSolutionForCaptcha()
    {
        /* @var \PHPUnit_Framework_MockObject_MockObject|DeathByCaptchaInterface $deathByCaptcha */
        $deathByCaptcha = $this->getMock(DeathByCaptchaInterface::class);

        $deathByCaptcha->expects($this->once())
            ->method('requestSolutionForCaptcha')
            ->with($this->isInstanceOf(CaptchaInterface::class));

        $only = new OnlyBase64AndFilesystemImageCaptcha($deathByCaptcha);

        $only->requestSolutionForCaptcha(Base64Captcha::fromString(''));
    }

    /**
     * @test
     */
    public function requestSolutionForCaptchaThrowsInvalidArgument()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        /* @var \PHPUnit_Framework_MockObject_MockObject|DeathByCaptchaInterface $deathByCaptcha */
        $deathByCaptcha = $this->getMock(DeathByCaptchaInterface::class);

        /* @var CaptchaInterface $captcha */
        $captcha = $this->getMock(CaptchaInterface::class);

        $only = new OnlyBase64AndFilesystemImageCaptcha($deathByCaptcha);

        $only->requestSolutionForCaptcha($captcha);
    }
}
