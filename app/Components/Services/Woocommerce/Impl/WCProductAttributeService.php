<?php

namespace App\Components\Services\Woocommerce\Impl;

use App\Components\Services\Woocommerce\IWCClientService;
use App\Components\Services\Woocommerce\IWCProductAttributeService;

class WCProductAttributeService implements IWCProductAttributeService
{
    private $_wcClientService;

    public function __construct(
        IWCClientService $wcClientService
    )
    {
        $this->_wcClientService = $wcClientService;
    }

    public function getProductAttributes($parameters = [])
    {
        return $this->_wcClientService->get("products/attributes", $parameters);
    }

    public function createProductAttribute($data)
    {
        return $this->_wcClientService->post("products/attributes", $data);
    }

    public function getProductAttribute($id)
    {
        return $this->_wcClientService->get("products/attributes/{$id}");
    }

    public function updateProductAttribute($id, $data)
    {
        return $this->_wcClientService->put("products/attributes/{$id}", $data);
    }

    public function deleteProductAttribute($id)
    {
        return $this->_wcClientService->delete("products/attributes/{$id}");
    }
}