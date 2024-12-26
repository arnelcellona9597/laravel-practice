<?php 
// File: app/Components/Services/Arnel/Impl/ProductService.php

namespace App\Components\Services\Arnel\Impl;

use App\Components\Services\Arnel\IProductService;
use App\Components\Repository\ProductRepository;

class ProductService implements IProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    // Fetch all products
    public function getProducts()
    {
        return $this->productRepository->getAll();
    }

    // Create a new product
    public function createProduct($data)
    {
        return $this->productRepository->create($data);
    }

    // Fetch a single product by ID
    public function getProductById($id)
    {
        return $this->productRepository->findById($id);
    }

    // Update a product by ID
    public function updateProduct($id, $data)
    {
        return $this->productRepository->update($id, $data);
    }

    // Delete a product by ID
    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }
}
