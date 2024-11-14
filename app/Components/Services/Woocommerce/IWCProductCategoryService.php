<?php

namespace App\Components\Services\Woocommerce;

interface IWCProductCategoryService
{
    public function getMaxPage();

    public function getProductCategories($parameters = []);

    public function createProductCategory($data);

    public function getProductCategory($id);

    public function updateProductCategory($id, $data);

    public function deleteProductCategory($id);

    public function batchProductCategory($data);
}
