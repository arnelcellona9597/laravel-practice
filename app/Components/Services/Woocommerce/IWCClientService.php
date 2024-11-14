<?php

namespace App\Components\Services\Woocommerce;

interface IWCClientService
{
    public function getLastResponseHeaders();

	public function get($endpoint, $parameters = []);

    public function post($endpoint, $data);

    public function put($endpoint, $data);

    public function delete($endpoint, $parameters = []);

    public function options($endpoint);
}