<?php

namespace App\Components\Services\Woocommerce;

interface IWCProductService
{
    public function getMaxPage();

    public function getProducts($parameters = []);

    public function createProduct($data);

    public function getProduct($id);

    public function updateProduct($id, $data);

    public function deleteProduct($id);

    public function batchProducts($data);
}
