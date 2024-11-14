<?php

namespace App\Components\Services\Woocommerce\Impl;

use App\Components\Services\Woocommerce\IWCClientService;
use App\Components\Services\Woocommerce\IWCCustomerService;

class WCCustomerService implements IWCCustomerService
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

    public function getCustomers($parameters = [])
    {
        return $this->_wcClientService->get("customers", $parameters);
    }

    public function createCustomer($data)
    {
        return $this->_wcClientService->post("customers", $data);
    }

    public function getCustomer($id)
    {
        return $this->_wcClientService->get("customers/{$id}");
    }

    public function updateCustomer($id, $data)
    {
        return $this->_wcClientService->put("customers/{$id}", $data);
    }

    public function deleteCustomer($id)
    {
        return $this->_wcClientService->delete("customers/{$id}");
    }

    public function batchCustomer($data)
    {
        return $this->_wcClientService->post("customers/batch", $data);
    }

}