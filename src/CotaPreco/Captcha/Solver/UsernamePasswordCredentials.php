<?php

namespace CotaPreco\Captcha\Solver;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class UsernamePasswordCredentials
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @param string $username
     * @param string $password
     */
    protected function __construct($username, $password)
    {
        $this->username = (string) $username;
        $this->password = (string) $password;
    }

    /**
     * @param  string $username
     * @param  string $password
     * @return static
     */
    public static function fromUsernameAndPassword($username, $password)
    {
        return new static($username, $password);
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
