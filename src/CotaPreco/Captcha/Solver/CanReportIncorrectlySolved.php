<?php

namespace CotaPreco\Captcha\Solver;

use CotaPreco\Captcha\CaptchaSolutionInterface;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
interface CanReportIncorrectlySolved
{
    /**
     * @param CaptchaSolutionInterface $solution
     */
    public function incorrectlySolved(CaptchaSolutionInterface $solution);
}
