<?php

namespace CotaPreco\Captcha\Solver;

use CotaPreco\Captcha\CaptchaInterface;
use CotaPreco\Captcha\CaptchaSolutionInterface;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
interface CaptchaSolverInterface
{
    /**
     * @param  CaptchaInterface $captcha
     * @return false|CaptchaSolutionInterface
     */
    public function requestSolutionForCaptcha(CaptchaInterface $captcha);
}
