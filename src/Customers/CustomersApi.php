<?php

namespace TenantCloud\TenantTurner\Customers;

use TenantCloud\TenantTurner\Customers\DTO\CustomerCreatedDTO;
use TenantCloud\TenantTurner\Customers\DTO\CustomerDTO;

interface CustomersApi
{
	public function create(CustomerDTO $customerDTO): CustomerCreatedDTO;

	public function deactivate(int $customerId): void;
}
