<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use CotaPreco\Captcha\Solver\CanReportIncorrectlySolved;
use CotaPreco\Captcha\Solver\CaptchaSolverInterface;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
interface DeathByCaptchaInterface extends CaptchaSolverInterface, CanReportIncorrectlySolved
{
}
