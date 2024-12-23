<?php

namespace App\Components\Services\Arnel;

interface IProductService
{
    public function getProducts();
    public function createProduct($data);
    public function getProductById($id);
    public function updateProduct($id, $data);
    public function deleteProduct($id);
}