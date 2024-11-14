<?php

namespace App\Components\Services\Woocommerce;

interface IWCCustomerService
{
    public function getCustomers($parameters = []);

    public function createCustomer($data);

    public function getCustomer($id);

    public function updateCustomer($id, $data);

    public function deleteCustomer($id);

    public function batchCustomer($data);

    public function getMaxPage();

    public function getTotalRows();
}