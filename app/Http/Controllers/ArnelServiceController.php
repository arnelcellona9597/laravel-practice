<?php 
// File: app/Http/Controllers/ArnelServiceController.php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Components\Services\Arnel\IArnelService;
use App\Components\Services\Arnel\IProductService;

class ArnelServiceController extends Controller
{
    private $arnelService;
    private $productService;

    public function __construct(IArnelService $arnelService, IProductService $productService)
    {
        $this->arnelService = $arnelService;
        $this->productService = $productService;
    }

    public function getData()
    {
        return response()->json(['data' => $this->arnelService->getArnelServiceData()]);
    }



    public function createProductView(Request $request)
    {
        $data = $request->only(['sku', 'name', 'quantity', 'price', 'product_id']);
        $this->productService->createProduct($data);
        return redirect('/arnel');
    }

    public function readProductsView(Request $request)
    {
        // Call viewGetProducts logic
        $products = $this->productService->getProducts();
        
  
        $searchParameter = $request->input('search');

        $updateParameter = $request->input('update');
      
        $product = null;
        if ($searchParameter) {
            $product = $this->productService->getProductBySearch($searchParameter);
        }
        
        $updateProduct = null;
        if ($updateParameter) {
            $updateProduct = $this->productService->getProductToUpdate($updateParameter);
        }

        // If product is not found, return a JSON response or show a message in the view
        if (!$product) {
            $product = null;  // You can pass null or handle this as per your requirements
        }
    
        // Return both in the same view
        return view('arnel.index', ['products' => $products, 'product' => $product, 'updateProduct' => $updateProduct ]);
    }

    // Update the form submission to handle POST requests
    public function updateProductView(Request $request)
    {
        $id = $request->input('id');   
        $data = $request->only(['sku', 'name', 'quantity', 'price', 'product_id' ]);
        $this->productService->updateProduct($id, $data);
        return redirect('/arnel');
    }

    public function deleteProductView($id)
    {
        $this->productService->deleteProduct($id);
        
        return redirect('/arnel');
    }

    // Update a product
    public function updateProduct(Request $request, $id)
    {
        $data = $request->only(['sku', 'name', 'quantity', 'price', 'product_id']);
        $updated = $this->productService->updateProduct($id, $data);

        if (!$updated) {
            return response()->json(['message' => 'Product not found or no changes made'], 404);
        }
        return response()->json(['message' => 'Product updated successfully']);
    }

    // Fetch all products
    public function getProducts()
    {
        $products = $this->productService->getProducts();
        return response()->json(['products' => $products]);
    }

    // Create a new product
    public function createProduct(Request $request)
    {
        $data = $request->only(['sku', 'name', 'quantity', 'price', 'product_id']);
        $this->productService->createProduct($data);
        return response()->json(['message' => 'Product created successfully']);
    }

    // Fetch a single product
    public function getProduct($id)
    {
        $product = $this->productService->getProductById($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json(['product' => $product]);
    }

    // Delete a product
    public function deleteProduct($id)
    {
        $deleted = $this->productService->deleteProduct($id);

        if (!$deleted) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json(['message' => 'Product deleted successfully']);
    }

}
