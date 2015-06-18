<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use CotaPreco\Captcha\FilesystemImageCaptcha;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class TransformFilesystemImageToBase64Test extends TestCase
{
    /**
     * @test
     */
    public function requestSolutionForCaptcha()
    {
        /* @var \PHPUnit_Framework_MockObject_MockObject|DeathByCaptchaInterface $deathByCaptcha */
        $deathByCaptcha = $this->getMock(DeathByCaptchaInterface::class);

        $root = vfsStream::setup();

        $root->addChild(new vfsStreamFile('1.jpg'));

        $captcha = FilesystemImageCaptcha::fromPath($root->url() . '/1.jpg');

        $transform = new TransformFilesystemImageToBase64($deathByCaptcha);

        $transform->requestSolutionForCaptcha($captcha);

        $this->assertFalse($root->hasChild('1.jpg'));
    }
}
