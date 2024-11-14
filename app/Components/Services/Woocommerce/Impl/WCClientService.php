<?php

namespace App\Components\Services\Woocommerce\Impl;

use App\Components\Services\Woocommerce\IWCClientService;
use App\Exceptions\ProcessException;
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use Illuminate\Support\Facades\Log;

class WCClientService implements IWCClientService 
{
    public $woocommerce;

    public function __construct()
    {
        $this->woocommerce = new Client(
            config('woocommerce.url'),
            config('woocommerce.consumer_key'),
            config('woocommerce.consumer_secret'),
            config('woocommerce.options')
        );
    }

    public function getLastResponseHeaders()
    { 
        $lastResponse = $this->woocommerce->http->getResponse();
        return isset($lastResponse) && $lastResponse ? $lastResponse->getHeaders():null;
    }

    public function get($endpoint, $parameters = [])
    {
        try {
            $results = $this->woocommerce->get($endpoint, $parameters);
          
            return $results;

        } catch (HttpClientException $e) {
            $this->throwError($e);
        }
    }

    public function post($endpoint, $data)
    {
        try {
            $results = $this->woocommerce->post($endpoint, $data);
          
            return $results;

        } catch (HttpClientException $e) {
            $this->throwError($e);
        }
    }

    public function put($endpoint, $data)
    {
        try {
            $results = $this->woocommerce->put($endpoint, $data);
          
            return $results;

        } catch (HttpClientException $e) {
            $this->throwError($e);
        }
    }

    public function delete($endpoint, $parameters = [])
    {
        try {
            $results = $this->woocommerce->delete($endpoint, $parameters);
          
            return $results;

        } catch (HttpClientException $e) {
            $this->throwError($e);
        }
    }

    public function options($endpoint)
    {
        try {
            $results = $this->woocommerce->options($endpoint);
          
            return $results;

        } catch (HttpClientException $e) {
            $this->throwError($e);
        }
    }

    private function throwError($e)
    {
        Log::error('Exception: '. $e->getMessage());
            
        throw new ProcessException(
            $e->getMessage(),
            $e->getCode()
        );
    }
}