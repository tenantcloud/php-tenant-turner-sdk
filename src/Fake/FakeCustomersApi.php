<?php

namespace TenantCloud\TenantTurner\Fake;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Str;
use TenantCloud\TenantTurner\Customers\CustomersApi;
use TenantCloud\TenantTurner\Customers\DTO\CustomerCreatedDTO;
use TenantCloud\TenantTurner\Customers\DTO\CustomerDTO;

class FakeCustomersApi implements CustomersApi
{
	public function __construct(
		private readonly Repository $cache
	) {}

	public function create(CustomerDTO $customerDTO): CustomerCreatedDTO
	{
		$customerId = random_int(1, PHP_INT_MAX);

		$this->cache->put(
			"customers.{$customerId}",
			$customerDTO->toArray()
		);

		return CustomerCreatedDTO::create()
			->setCustomerId($customerId)
			->setListingPhone('15555' . random_int(111111, 999999))
			->setListingEmail("leads+{$customerId}@tenantturnermail.com")
			->setApiKey(Str::random());
	}

	public function deactivate(int $customerId): void
	{
		// do nothing
	}
}
