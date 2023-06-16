<?php 
namespace App\Services;

use GuzzleHttp\Client;

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

    public function post($url, $options = [])
    {
        return $this->client->post($url, $options);
    }
}
