<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use CotaPreco\Captcha\CaptchaInterface;
use CotaPreco\Captcha\Solver\DeathByCaptcha\Exception\ServiceTemporarilyOverloadedException;
use GuzzleHttp\Exception\ServerException;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class OnServiceUnavailable extends AbstractDeathByCaptchaWrapper
{
    /**
     * {@inheritDoc}
     */
    public function requestSolutionForCaptcha(CaptchaInterface $captcha)
    {
        try {
            return parent::requestSolutionForCaptcha($captcha);
        } catch (ServerException $e) {
            throw new ServiceTemporarilyOverloadedException();
        }
    }
}
