<?php

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
