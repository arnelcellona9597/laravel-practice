<?php

namespace App\Components\Services\Woocommerce\Impl;

use App\Components\Services\Woocommerce\IWCClientService;
use App\Components\Services\Woocommerce\IWCProductService;

class WCProductService implements IWCProductService
{
    private $_wcClientService;

    public function __construct(
        IWCClientService $wcClientService
    ) {
        $this->_wcClientService = $wcClientService;
    }

    public function getMaxPage()
    {
        return $this->_wcClientService->getLastResponseHeaders()['X-WP-TotalPages'] ?? null;
    }

    public function getProducts($parameters = [])
    {
        return $this->_wcClientService->get("products", $parameters);
    }

    public function createProduct($data)
    {
        return $this->_wcClientService->post("products", $data);
    }

    public function getProduct($id)
    {
        return $this->_wcClientService->get("products/{$id}");
    }

    public function updateProduct($id, $data)
    {
        return $this->_wcClientService->put("products/{$id}", $data);
    }

    public function deleteProduct($id)
    {
        return $this->_wcClientService->delete("products/{$id}");
    }

    public function batchProducts($data)
    {
        return $this->_wcClientService->post("products/batch", $data);
    }
}
