<?php

namespace TenantCloud\TenantTurner\Customers;

use TenantCloud\TenantTurner\Customers\DTO\CustomerCreatedDTO;
use TenantCloud\TenantTurner\Customers\DTO\CustomerCreateDTO;
use TenantCloud\TenantTurner\Customers\DTO\StatusDTO;

interface CustomersApi
{
	public function create(CustomerCreateDTO $customerDTO): CustomerCreatedDTO;

	public function invalidateApiKey(int $customerId, string $apiKey): string;

	public function getStatus(int $customerId): StatusDTO;

	public function deactivate(int $customerId): void;
}
