<?php

namespace App\Components\Services\Woocommerce;

interface IWCProductAttributeService
{
    public function getProductAttributes($parameters = []);

    public function createProductAttribute($data);

    public function getProductAttribute($id);

    public function updateProductAttribute($id, $data);

    public function deleteProductAttribute($id);
}