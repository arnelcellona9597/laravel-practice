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

    // FOR API CONTROLLERS
    public function getOrders()
    {
        $orders = $this->wooOrderService->getOrders();
        return $orders;
    }

    public function getOrderByOrderID( $order_id )
    {
        $orders = $this->wooOrderService->getOrderByOrderID( $order_id );
        return $orders;
    }

    public function searchOrder( $search )
    {
        $orders = $this->wooOrderService->searchOrder( $search );
        return $orders;
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

    // FOR WEB CONTROLLERS
    public function wooOrdersViewIndex(Request $request)
    {
        $orders = $this->wooOrderService->getOrders()->sortByDesc('id');

        $searchInput = $request->input('search');
        $searchOrder = null;
        if ($searchInput) {
            $searchOrder = $this->wooOrderService->searchOrder($searchInput);
        }

        $updateParameter = $request->input('update');
        $updateOrder = null;
        if ($updateParameter) {
            $updateOrder = $this->wooOrderService->getOrderToUpdate($updateParameter);
        }
        
        return view('woo-orders.index', ['orders' => $orders, 'searchOrder' => $searchOrder, 'updateOrder' => $updateOrder ]);
    }

    public function updateProductViewIndex( Request $request )
    {
        $order_id = $request->input('order_id');
        $data = $request->only(['order_id', 'customer_name', 'customer_email', 'total', 'status']);
        $this->wooOrderService->updateOrder($order_id, $data);
        return redirect('/woo-orders');
    }

    public function deleteOrderView($order_id)
    {
        $this->wooOrderService->deleteOrder($order_id);
        return redirect('/woo-orders');
    }

    public function addOrderView(Request $request)
    {
        $data = $request->only(['order_id', 'customer_name', 'customer_email', 'total', 'status']);
        $this->wooOrderService->addOrder($data);
        return redirect('/woo-orders');
    }
    
}
