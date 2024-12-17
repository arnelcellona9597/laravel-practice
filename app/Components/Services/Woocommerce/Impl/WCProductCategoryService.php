<?php

namespace App\Components\Services\Woocommerce\Impl;

use App\Components\Services\Woocommerce\IWCClientService;
use App\Components\Services\Woocommerce\IWCProductCategoryService;

class WCProductCategoryService implements IWCProductCategoryService
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

    public function getProductCategories($parameters = [])
    {
        return $this->_wcClientService->get("products/categories", $parameters);
    }

    public function createProductCategory($data)
    {
        return $this->_wcClientService->post("products/categories", $data);
    }

    public function getProductCategory($id)
    {
        return $this->_wcClientService->get("products/categories/{$id}");
    }

    public function updateProductCategory($id, $data)
    {
        return $this->_wcClientService->put("products/categories/{$id}", $data);
    }

    public function deleteProductCategory($id)
    {
        return $this->_wcClientService->delete("products/categories/{$id}");
    }

    public function batchProductCategory($data)
    {
        return $this->_wcClientService->post("products/categories/batch", $data);
    }
}
