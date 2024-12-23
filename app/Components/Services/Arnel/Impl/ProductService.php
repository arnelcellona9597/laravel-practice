<?php 
// File: app/Components/Services/Arnel/Impl/ProductService.php

namespace App\Components\Services\Arnel\Impl;

use App\Components\Services\Arnel\IProductService;
use Illuminate\Support\Facades\DB;

class ProductService implements IProductService
{
    // Fetch all products
    public function getProducts()
    {
        return DB::table('products')->get();
    }

    // Create a new product
    public function createProduct($data)
    {
        return DB::table('products')->insert($data);
    }

    // Fetch a single product by ID
    public function getProductById($id)
    {
        return DB::table('products')->find($id);
    }

    // Update a product by ID
    public function updateProduct($id, $data)
    {
        return DB::table('products')->where('id', $id)->update($data);
    }

    // Delete a product by ID
    public function deleteProduct($id)
    {
        return DB::table('products')->where('id', $id)->delete();
    }
}
