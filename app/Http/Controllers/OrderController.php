<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|integer',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'total' => 'required|numeric',
            'status' => 'required|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|integer',
            'items.*.name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer',
            'items.*.subtotal' => 'required|numeric',
            'items.*.total' => 'required|numeric',
        ]);

        // Store the order
        $order = Order::create([
            'order_id' => $validated['order_id'],
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'total' => $validated['total'],
            'status' => $validated['status'],
        ]);

        // Store the order items
        foreach ($validated['items'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['subtotal'],
                'total' => $item['total'],
            ]);
        }

        return response()->json(['message' => 'Order saved successfully!'], 201);
    }
}
