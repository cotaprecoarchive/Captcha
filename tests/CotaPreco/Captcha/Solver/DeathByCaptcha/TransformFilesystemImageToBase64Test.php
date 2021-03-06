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
