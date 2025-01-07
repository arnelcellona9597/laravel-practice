<?php

namespace App\Components\Repository;

use App\Models\WooOrder;

class WooOrderRepository
{

    public function getOrders()
    {
        return WooOrder::orderByRaw('updated_at - created_at DESC')->get();
    }

    public function getOrderByOrderID( $order_id )
    {
        return WooOrder::where('order_id', 'like', '%' . $order_id . '%')->first();  
    }
 
    public function searchOrder( string $search )
    {
        return WooOrder::where('order_id', 'like', '%' . $search . '%')
        ->orWhere('customer_name', 'like', '%' . $search . '%')
        ->orWhere('customer_email', 'like', '%' . $search . '%')
        ->orWhere('total', 'like', '%' . $search . '%')
        ->orWhere('status', 'like', '%' . $search . '%')->get(); // This returns a single model
    }

    public function getOrderToUpdate(string $search)
    {
        return WooOrder::where('order_id', 'like', '%' . $search . '%')->first();  
    }

    public function addOrder(array $data)
    {
        return WooOrder::create($data);
    }

    
    public function updateOrder($order_id, array $data)
    {
        $order = WooOrder::where('order_id',  $order_id )->first();  
        if (!$order) {
            return false;
        }
        $order->update($data);
        return $order;
    }


    public function deleteOrder($order_id)
    {
        $order = WooOrder::where('order_id',  $order_id )->first(); 
        if (!$order) {
            return false;
        }
        $order->delete();
        return true;
    }

}
