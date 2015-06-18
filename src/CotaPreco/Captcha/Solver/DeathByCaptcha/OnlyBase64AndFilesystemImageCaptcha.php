<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use CotaPreco\Captcha\Base64Captcha;
use CotaPreco\Captcha\CaptchaInterface;
use CotaPreco\Captcha\FilesystemImageCaptcha;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class OnlyBase64AndFilesystemImageCaptcha extends AbstractDeathByCaptchaWrapper
{
    /**
     * {@inheritDoc}
     */
    public function requestSolutionForCaptcha(CaptchaInterface $captcha)
    {
        if ($captcha instanceof FilesystemImageCaptcha || $captcha instanceof Base64Captcha) {
            return parent::requestSolutionForCaptcha($captcha);
        }

        throw new \InvalidArgumentException(
            sprintf(
                '`$captcha` deve ser uma instância de `%s` ou `%s`, `%s` foi dado',
                FilesystemImageCaptcha::class,
                Base64Captcha::class,
                gettype($captcha)
            )
        );
    }
}
