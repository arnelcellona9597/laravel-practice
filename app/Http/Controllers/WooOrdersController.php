<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Components\Services\WooOrder\IWooOrderService;

class WooOrdersController extends Controller
{
    //
    private $wooOrderService;

    public function __construct(IWooOrderService $wooOrderService)
    {
        $this->wooOrderService = $wooOrderService;
    }

    public function getOrders()
    {
        $products = $this->wooOrderService->getOrders();
        return $products;
    }

    public function getOrderByOrderID( $order_id )
    {
        $products = $this->wooOrderService->getOrderByOrderID( $order_id );
        return $products;
    }

    public function searchOrder( $search )
    {
        $products = $this->wooOrderService->searchOrder( $search );
        return $products;
    }

    public function addOrder(Request $request)
    {
        $data = $request->only(['order_id', 'customer_name', 'customer_email', 'total', 'status']);
        $this->wooOrderService->addOrder($data);
        return response()->json(['message' => 'Order created successfully']);
    }


    public function updateOrder($order_id, Request $request)
    {
        $data = $request->only(['order_id', 'customer_name', 'customer_email', 'total', 'status']);
        $this->wooOrderService->updateOrder($order_id, $data);
        return response()->json(['message' => 'Order updated successfully']);
    }

    public function deleteOrder($order_id)
    {
        $this->wooOrderService->deleteOrder($order_id);
        return response()->json(['message' => 'Order deleted successfully']);
    }
    
}
