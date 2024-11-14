<?php

namespace App\Components\Services\Woocommerce\Impl;

use App\Components\Services\Woocommerce\IWCClientService;
use App\Components\Services\Woocommerce\IWCOrderService;

class WCOrderService implements IWCOrderService
{
    private $_wcClientService;

    public function __construct(
        IWCClientService $wcClientService
    )
    {
        $this->_wcClientService = $wcClientService;
    }

    public function getMaxPage()
    {
        return $this->_wcClientService->getLastResponseHeaders()['X-WP-TotalPages'] ?? null;
    }

    public function getTotalRows()
    {
        return $this->_wcClientService->getLastResponseHeaders()['X-WP-Total'] ?? null;
    }
   
    public function getOrders($parameters = [])
    {
        return $this->_wcClientService->get("orders", $parameters);
    }

    public function createOrder($data)
    {
        return $this->_wcClientService->post("orders", $data);
    }

    public function createOrderNote($id, $data)
    {
        return $this->_wcClientService->post("orders/{$id}/notes", $data);
    }

    public function getOrder($id)
    {
        return $this->_wcClientService->get("orders/{$id}");
    }

    public function updateOrder($id, $data)
    {
        return $this->_wcClientService->put("orders/{$id}", $data);
    }

    public function deleteOrder($id)
    {
        return $this->_wcClientService->delete("orders/{$id}");
    }

    public function batchOrders($data)
    {
        return $this->_wcClientService->post("orders/batch", $data);
    }
}