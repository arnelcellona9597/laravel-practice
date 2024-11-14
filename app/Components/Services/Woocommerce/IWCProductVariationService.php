<?php

namespace App\Components\Services\Woocommerce;

interface IWCProductVariationService
{
    public function getProductVariations($product_id, $parameters = []);

    public function createProductVariation($product_id, $data);

    public function getProductVariation($product_id, $id);

    public function updateProductVariation($product_id, $id, $data);

    public function deleteProductVariation($product_id, $id);

    public function batchProductVariation($product_id, $data);
}