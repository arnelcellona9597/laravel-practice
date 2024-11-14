<?php

namespace App\Components\Services\Woocommerce\Impl;

use App\Components\Services\Woocommerce\IWCClientService;
use App\Components\Services\Woocommerce\IWCProductAttributeTermService;

class WCProductAttributeTermService implements IWCProductAttributeTermService
{
    private $_wcClientService;

    public function __construct(
        IWCClientService $wcClientService
    )
    {
        $this->_wcClientService = $wcClientService;
    }

    public function getProductAttributeTerms($attribute_id, $parameters = [])
    {
        return $this->_wcClientService->get("products/attributes/{$attribute_id}/terms", $parameters);
    }

    public function createProductAttributeTerm($attribute_id, $data)
    {
        return $this->_wcClientService->post("products/attributes/{$attribute_id}/terms", $data);
    }

    public function getProductAttributeTerm($attribute_id, $id)
    {
        return $this->_wcClientService->get("products/attributes/{$attribute_id}/terms/{$id}");
    }

    public function updateProductAttributeTerm($attribute_id, $id, $data)
    {
        return $this->_wcClientService->put("products/attributes/{$attribute_id}/terms/{$id}", $data);
    }

    public function deleteProductAttribute($attribute_id, $id)
    {
        return $this->_wcClientService->delete("products/attributes/{$attribute_id}/terms/{$id}");
    }
}