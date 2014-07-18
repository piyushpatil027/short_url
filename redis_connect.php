<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'predis_lib/autoload.php';

class Redis_Connect {

    private $client;

    public function __construct() {
        try {
            $this->client = new Predis\Client([
                'scheme' => 'tcp',
                'host' => '127.0.0.1',
                'port' => 6379,
            ]);
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    public function set($key, $value) {
        $this->client->set($key, $value);
    }

    public function get($key) {
        return $this->client->get($key);
    }

}
