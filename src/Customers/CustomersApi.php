<?php

namespace TenantCloud\TenantTurner\Customers;

use TenantCloud\TenantTurner\Customers\DTO\CustomerCreatedDTO;
use TenantCloud\TenantTurner\Customers\DTO\CustomerCreateDTO;
use TenantCloud\TenantTurner\Customers\DTO\RefreshedApiKeyDTO;
use TenantCloud\TenantTurner\Customers\DTO\StatusDTO;

interface CustomersApi
{
	public function create(CustomerCreateDTO $customerDTO): CustomerCreatedDTO;

	public function refreshApiKey(int $customerId, string $apiKey): RefreshedApiKeyDTO;

	public function status(int $customerId): StatusDTO;

	public function deactivate(int $customerId): void;
}
