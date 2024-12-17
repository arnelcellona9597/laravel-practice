<?php

namespace App\Traits\Connector;

use App\Exceptions\ProcessException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException; 
use Illuminate\Support\Facades\Log; 


trait ClientGuzzle {

    private $_client;

    private $_headers; 
   
    private $_query; 

    public function sendRequest($endpoint, $data = [], $method = 'POST', $format = 'json')
    {
        try {  

            if ($format == 'json') {
                $this->_headers['Accept'] = 'application/json';
                $this->_headers['Content-Type'] = 'application/json';
            }

            $args = [
                'headers' => $this->_headers,
            ];

            if ($format == 'multipart') {
                $args['multipart'] = $data;
            } else {
                $args['json'] = $data;
            }

            $result = $this->_client->request($method, $endpoint, $args);

            return json_decode($result->getBody()->getContents(), true);

        } catch (Exception $e) {
            $this->throwError($e);
        }
    }

    public function getRequest($endpoint, $query = [])
    {
        try {
            $this->_headers['Accept'] = 'application/json';
            $this->_headers['Content-Type'] = 'application/json';

            $result = $this->_client->request(
                'GET',
                $endpoint,
                [
                    'headers' => $this->_headers,
                    'query' => $query
                ]
            );

            return json_decode($result->getBody()->getContents(), true);

        } catch (ClientException $e) {
            $this->throwError($e);
        }
    }

    private function throwError($e)
    {
        Log::error('Exception: '. $e->getMessage());
        throw new ProcessException(
            json_decode($e->getMessage(), true), $e->getCode()
        );
    }
}