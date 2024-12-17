<?php

namespace App\Components\Services\Woocommerce;

interface IWCOrderService
{
    public function getOrders($parameters = []);

    public function createOrder($data);

    public function getOrder($id);

    public function updateOrder($id, $data);

    public function deleteOrder($id);
    
    public function getMaxPage();

    public function getTotalRows();

    public function batchOrders($data);

    public function createOrderNote($id, $data);
}