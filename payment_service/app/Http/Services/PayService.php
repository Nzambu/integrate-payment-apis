<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class PayService {

    public $client;
    public $headers;

    public function __construct()
    {
        $this->headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];
        $this->client = new Client(['base_uri' => 'https://apis.staging.ipayafrica.com/']);
    }

    public function transact($request)
    {
        
        $method = 'POST';
        $endpoint = "b2c/v3/mobile/mpesa";
        $form_params = $request;
        
        return $this->make_http_request($method, $endpoint, $form_params);
        
    }

    public function search($search)
    {
        
        $method = 'GET';
        $endpoint = "b2c/v3/mobile/mpesa/{$search}";

        return $this->make_http_request($method, $endpoint);
    }

    public function make_http_request($method, $endpoint, $form_params = [])
    {
        try {

            $response = $this->client->request($method, $endpoint, [
                'headers' => $this->headers,
                'json' => $form_params,
            ]);        
    
            $body = $response->getBody();

            return json_decode($body->getContents(), true);

        } catch (ClientException $exception) {

            throw $exception;

        } 
    }
}