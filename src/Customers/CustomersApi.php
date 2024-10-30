<?php

namespace TenantCloud\TenantTurner\Customers;

use TenantCloud\TenantTurner\Customers\DTO\CustomerCreatedDTO;
use TenantCloud\TenantTurner\Customers\DTO\CustomerDTO;
use TenantCloud\TenantTurner\Customers\DTO\RefreshedApiKeyDTO;

interface CustomersApi
{
	public function create(CustomerDTO $customerDTO): CustomerCreatedDTO;

	public function refreshApiKey(int $customerId, string $apiKey): RefreshedApiKeyDTO;

	public function deactivate(int $customerId): void;
}
