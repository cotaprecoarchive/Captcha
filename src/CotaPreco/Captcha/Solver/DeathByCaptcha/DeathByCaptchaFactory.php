<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use CotaPreco\Captcha\Solver\UsernamePasswordCredentials;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
final class DeathByCaptchaFactory
{
    /**
     * @param  UsernamePasswordCredentials $credentials
     * @param  PullPreferences             $preferences
     * @return DeathByCaptchaInterface
     */
    public static function createWithPreferences(
        UsernamePasswordCredentials $credentials,
        PullPreferences $preferences
    ) {
        return new OnServiceUnavailable(
            new OnlyBase64AndFilesystemImageCaptcha(
                new TransformFilesystemImageToBase64(
                    new DeathByCaptcha(
                        $credentials,
                        $preferences
                    )
                )
            )
        );
    }

    /**
     * @param  UsernamePasswordCredentials $credentials
     * @return DeathByCaptchaInterface
     */
    public static function createWithDefaultPreferences(
        UsernamePasswordCredentials $credentials
    ) {
        return self::createWithPreferences($credentials, PullPreferences::fromRecommendedPreferences());
    }
}
