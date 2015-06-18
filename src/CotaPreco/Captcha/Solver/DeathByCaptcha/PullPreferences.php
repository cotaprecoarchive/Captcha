<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
final class PullPreferences
{
    /**
     * @var int
     */
    private $interval;

    /**
     * @var int
     */
    private $maxAttempts;

    /**
     * @param int $interval
     * @param int $maxAttempts
     */
    protected function __construct($interval = 5, $maxAttempts = 5)
    {
        $this->interval    = (int) $interval;
        $this->maxAttempts = (int) $maxAttempts;
    }

    /**
     * @param  int $interval
     * @param  int $maxAttempts
     * @return self
     */
    public static function fromPreferences($interval, $maxAttempts)
    {
        return new self($interval, $maxAttempts);
    }

    /**
     * @return PullPreferences
     */
    public static function fromRecommendedPreferences()
    {
        return new self(5, 5);
    }

    /**
     * @return int
     */
    public function getMaxAttempts()
    {
        return $this->maxAttempts;
    }

    /**
     * @return int
     */
    public function getInterval()
    {
        return $this->interval;
    }
}
