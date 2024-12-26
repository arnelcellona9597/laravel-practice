<?php

namespace App\Components\Repository;

use App\Models\Product;

class ProductRepository
{
    // Fetch all products
    public function getAll()
    {
        return Product::all();
    }

    // Create a new product
    public function create(array $data)
    {
        return Product::create($data);
    }

    // Fetch a single product by ID
    public function findById($id)
    {
        return Product::find($id);
    }

    // Update a product by ID
    public function update($id, array $data)
    {
        $product = Product::find($id);

        if (!$product) {
            return false;
        }

        $product->update($data);
        return $product;
    }

    // Delete a product by ID
    public function delete($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return false;
        }

        $product->delete();
        return true;
    }
}
