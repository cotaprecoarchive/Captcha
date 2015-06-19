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

namespace CotaPreco\Captcha;

use org\bovigo\vfs\DotDirectory;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class FilesystemImageCaptchaTest extends TestCase
{
    /**
     * @var vfsStreamDirectory
     */
    private $root;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->root = vfsStream::setup();

        $this->root->addChild(new vfsStreamFile('1.png'));
        $this->root->addChild(new vfsStreamFile('2.jpg'));
        $this->root->addChild(new vfsStreamFile('3.jpeg'));
    }

    /**
     * @test
     */
    public function fromPathThrowsInvalidArgument()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        FilesystemImageCaptcha::fromPath(null);
    }

    /**
     * @test
     */
    public function getPath()
    {
        foreach ($this->getImages() as $path) {
            $captcha = FilesystemImageCaptcha::fromPath($path);

            $this->assertEquals($path, $captcha->getPath());
        }
    }

    /**
     * @return \Generator<string>
     */
    private function getImages()
    {
        /* @var vfsStreamFile|DotDirectory $file */
        foreach ($this->root as $file) {
            $fileUrl = $file->url();

            if (is_file($fileUrl)) {
                yield $fileUrl;
            }
        }
    }
}
