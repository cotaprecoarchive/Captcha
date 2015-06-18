<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use CotaPreco\Captcha\Base64Captcha;
use CotaPreco\Captcha\CaptchaInterface;
use CotaPreco\Captcha\FilesystemImageCaptcha;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class TransformFilesystemImageToBase64 extends AbstractDeathByCaptchaWrapper
{
    /**
     * {@inheritDoc}
     * @param FilesystemImageCaptcha $captcha
     */
    public function requestSolutionForCaptcha(CaptchaInterface $captcha)
    {
        if ($captcha instanceof FilesystemImageCaptcha) {
            $base64 = base64_encode(file_get_contents($captcha->getPath()));

            unlink($captcha->getPath());

            $captcha = Base64Captcha::fromString($base64);
        }

        return parent::requestSolutionForCaptcha($captcha);
    }
}
