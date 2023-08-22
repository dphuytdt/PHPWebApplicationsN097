<?php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HttpService
{
    private static $instance;

    private $client;

    private function __construct()
    {
        $this->client = new Client([
            'timeout' => 30,
        ]);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getClient()
    {
        return $this->client;
    }

    /**
     * @throws GuzzleException
     */
    public function post($url, $options = [])
    {
        return $this->client->post($url, $options);
    }
}
