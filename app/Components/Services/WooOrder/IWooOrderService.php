<?php

namespace App\Components\Services\WooOrder;

interface IWooOrderService
{
    public function getOrders();
    public function getOrderByOrderID( $order_id );
    public function searchOrder( string $search );
    public function addOrder( $data );
    public function updateOrder($order_id, array $data);
    public function deleteOrder($order_id);
    public function getOrderToUpdate(string $search);
} 