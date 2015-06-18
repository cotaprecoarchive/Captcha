<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use CotaPreco\Captcha\CaptchaInterface;
use CotaPreco\Captcha\CaptchaSolutionInterface;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
abstract class AbstractDeathByCaptchaWrapper implements DeathByCaptchaInterface
{
    /**
     * @var DeathByCaptchaInterface
     */
    protected $deathByCaptcha;

    /**
     * @param DeathByCaptchaInterface $deathByCaptcha
     */
    public function __construct(DeathByCaptchaInterface $deathByCaptcha)
    {
        $this->deathByCaptcha = $deathByCaptcha;
    }

    /**
     * {@inheritDoc}
     */
    public function requestSolutionForCaptcha(CaptchaInterface $captcha)
    {
        return $this->deathByCaptcha->requestSolutionForCaptcha($captcha);
    }

    /**
     * {@inheritDoc}
     */
    public function incorrectlySolved(CaptchaSolutionInterface $solution)
    {
        return $this->deathByCaptcha->incorrectlySolved($solution);
    }
}
