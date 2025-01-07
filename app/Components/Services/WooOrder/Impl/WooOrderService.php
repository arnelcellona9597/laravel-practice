<?php

namespace App\Components\Services\WooOrder\Impl;

use App\Components\Services\WooOrder\IWooOrderService;
use App\Components\Repository\WooOrderRepository;

class WooOrderService implements IWooOrderService
{
    private $productRepository;

    public function __construct(WooOrderRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getOrders() 
    {
        return $this->productRepository->getOrders();
    }
 
    public function getOrderByOrderID( $order_id ) 
    {
        return $this->productRepository->getOrderByOrderID( $order_id );
    }

    public function searchOrder( string $search ) 
    {
        return $this->productRepository->searchOrder( $search );
    }

    public function addOrder( $data ) 
    {
        return $this->productRepository->addOrder( $data );
    }
    
    public function updateOrder($order_id, array $data)
    {
        return $this->productRepository->updateOrder( $order_id, $data );
    }

 
    public function deleteOrder($order_id)
    {
        return $this->productRepository->deleteOrder( $order_id );
    }

    public function getOrderToUpdate(string $search) {
        return $this->productRepository->getOrderToUpdate( $search );
    }
    
} 