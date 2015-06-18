<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use CotaPreco\Captcha\CaptchaSolution;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
final class DeathByCaptchaCaptchaSolution extends CaptchaSolution
{
    /**
     * @var string
     */
    private $captchaId;

    /**
     * {@inheritDoc}
     * @param string $captchaId
     */
    public function __construct($solution, $captchaId)
    {
        $this->captchaId = (string) $captchaId;

        parent::__construct($solution);
    }

    /**
     * @return string
     */
    public function getCaptchaId()
    {
        return $this->captchaId;
    }
}
