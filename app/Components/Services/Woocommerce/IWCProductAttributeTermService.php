<?php

namespace App\Components\Services\Woocommerce;

interface IWCProductAttributeTermService
{
    public function getProductAttributeTerms($attribute_id, $parameters = []);

    public function createProductAttributeTerm($attribute_id, $data);

    public function getProductAttributeTerm($attribute_id, $id);

    public function updateProductAttributeTerm($attribute_id, $id, $data);

    public function deleteProductAttribute($attribute_id, $id);
}