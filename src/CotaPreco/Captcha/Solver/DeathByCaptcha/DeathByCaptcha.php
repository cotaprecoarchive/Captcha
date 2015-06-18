<?php

namespace CotaPreco\Captcha\Solver\DeathByCaptcha;

use CotaPreco\Captcha\Base64Captcha;
use CotaPreco\Captcha\CaptchaInterface;
use CotaPreco\Captcha\CaptchaSolutionInterface;
use CotaPreco\Captcha\FilesystemImageCaptcha;
use CotaPreco\Captcha\Solver\UsernamePasswordCredentials;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\Response;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class DeathByCaptcha implements DeathByCaptchaInterface
{
    /**
     * @var UsernamePasswordCredentials
     */
    private $credentials;

    /**
     * @var PullPreferences
     */
    private $pullPreferences;

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     * @param UsernamePasswordCredentials $credentials
     * @param PullPreferences             $pullPreferences
     * @param ClientInterface             $httpClient
     */
    public function __construct(
        UsernamePasswordCredentials $credentials,
        PullPreferences $pullPreferences = null,
        ClientInterface $httpClient = null
    ) {
        $this->credentials = $credentials;

        $this->pullPreferences
            = $pullPreferences ?: PullPreferences::fromRecommendedPreferences();

        $this->httpClient = $httpClient ?: new Client([
            'base_url' => 'http://api.dbcapi.me',
            'defaults' => [
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]
        ]);
    }

    /**
     * @param  string $captchaId
     * @return false|DeathByCaptchaCaptchaSolution
     */
    private function pullSolutionFor($captchaId)
    {
        $maxAttempts = $this->pullPreferences->getMaxAttempts();

        while ($maxAttempts --) {
            /* @var Response $response */
            $response = $this->httpClient->get('/api/captcha/' . $captchaId, [
                'query' => [
                    'username' => $this->credentials->getUsername(),
                    'password' => $this->credentials->getPassword()
                ]
            ]);

            $json = $response->json();

            if (! empty($json['text'])) {
                return new DeathByCaptchaCaptchaSolution(
                    $json['text'],
                    $captchaId
                );
            }

            sleep($this->pullPreferences->getInterval());
        }

        return false;
    }

    /**
     * @param Base64Captcha|FilesystemImageCaptcha $captcha
     * {@inheritDoc}
     */
    public function requestSolutionForCaptcha(CaptchaInterface $captcha)
    {
        /* @var Response $response */
        $response = $this->httpClient->post('/api/captcha', [
            'body' => [
                'captchafile' => sprintf('base64:%s', $captcha),
                'username' => $this->credentials->getUsername(),
                'password' => $this->credentials->getPassword()
            ]
        ]);

        $json = $response->json();

        if (! isset($json['captcha'])) {
            return false;
        }

        return $this->pullSolutionFor($json['captcha']);
    }

    /**
     * {@inheritDoc}
     */
    public function incorrectlySolved(CaptchaSolutionInterface $solution)
    {
        if (! $solution instanceof DeathByCaptchaCaptchaSolution) {
            return false;
        }

        $this->httpClient->post('/api/captcha/' . $solution->getCaptchaId() . '/report');

        return true;
    }
}
