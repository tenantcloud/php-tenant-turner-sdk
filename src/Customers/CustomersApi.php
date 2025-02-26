<?php

namespace TenantCloud\TenantTurner\Customers;

use TenantCloud\TenantTurner\Customers\DTO\CustomerCreatedDTO;
use TenantCloud\TenantTurner\Customers\DTO\CustomerCreateDTO;

interface CustomersApi
{
	public function create(CustomerCreateDTO $customerDTO): CustomerCreatedDTO;

	public function deactivate(int $customerId): void;
}
