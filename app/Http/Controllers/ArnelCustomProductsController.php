<?php 
namespace App\Http\Controllers;

use App\Models\ArnelCustomProducts;
use Illuminate\Http\Request;

class ArnelCustomProductsController extends Controller
{

    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validated = $request->validate([
                'product_id' => 'nullable|string|max:255', 
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
            ]);

            // Create a new product
            $product = ArnelCustomProducts::create($validated);

            // Return the newly created product
            return response()->json($product, 201);

        } catch (\Exception $e) {
            // Return error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Get all products
    public function index()
    {
        return response()->json(ArnelCustomProducts::all());
    }

    // // Get all products with price > 100
    // public function index()
    // {
    //     $products = ArnelCustomProducts::where('price', '>', 100)->get();

    //     return response()->json($products);
    // }

    // Get a single product by ID
    public function show($id)
    {
        $product = ArnelCustomProducts::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    // Update a product
    public function update(Request $request, $id)
    {
        // Find the product by ID
        $product = ArnelCustomProducts::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Validate incoming data
        $validated = $request->validate([
            'product_id' => 'nullable|string|max:255', // Optional if not always updated
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
        ]);

        // Update the product with validated data
        $product->update($validated);

        // Return the updated product
        return response()->json($product);
    }

    // Delete a product
    public function destroy($id)
    {
        // Find the product by ID
        $product = ArnelCustomProducts::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Delete the product
        $product->delete();

        // Return a success message
        return response()->json(['message' => 'Product deleted successfully']);
    }

}
