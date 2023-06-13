<?php 
namespace App\Services;

use GuzzleHttp\Client;

class HttpService
{
    private static $instance;
    private $client;

    private function __construct()
    {
        $this->client = new Client();
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
}
