<?php

namespace App\Components\Services\Woocommerce\Impl;

use App\Components\Services\Woocommerce\IWCClientService;
use App\Components\Services\Woocommerce\IWCProductVariationService;
use Illuminate\Support\Facades\Log;
class WCProductVariationService implements IWCProductVariationService
{
    private $_wcClientService;

    public function __construct(
        IWCClientService $wcClientService
    )
    {
        $this->_wcClientService = $wcClientService;
    }

    public function getProductVariations($product_id, $parameters = [])
    {
        return $this->_wcClientService->get("products/{$product_id}/variations", $parameters);
    }

    public function createProductVariation($product_id, $data)
    {
        return $this->_wcClientService->post("products/{$product_id}/variations", $data);
    }

    public function getProductVariation($product_id, $id)
    {
        return $this->_wcClientService->get("products/{$product_id}/variations/{$id}");
    }

    public function updateProductVariation($product_id, $id, $data)
    {
        return $this->_wcClientService->put("products/{$product_id}/variations/{$id}", $data);
    }

    public function deleteProductVariation($product_id, $id)
    {
        return $this->_wcClientService->delete("products/{$product_id}/variations/{$id}");
    }

    public function batchProductVariation($product_id, $data)
    {
        return $this->_wcClientService->post("products/{$product_id}/variations/batch", $data);
    }
}