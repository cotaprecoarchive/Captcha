<?php

namespace CotaPreco\Captcha;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
final class FilesystemImageCaptcha implements CaptchaInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @param string $path
     */
    private function __construct($path)
    {
        $this->path = (string) $path;
    }

    /**
     * @throws \InvalidArgumentException se o arquivo (imagem) não existir
     * @param  string $path
     * @return self
     */
    public static function fromPath($path)
    {
        if (! file_exists($path)) {
            throw new \InvalidArgumentException('A imagem `'. $path .'` não existe');
        }

        return new self($path);
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
