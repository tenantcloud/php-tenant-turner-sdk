<?php

namespace TenantCloud\TenantTurner\Fake;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Str;
use TenantCloud\TenantTurner\Customers\CustomersApi;
use TenantCloud\TenantTurner\Customers\DTO\CustomerCreatedDTO;
use TenantCloud\TenantTurner\Customers\DTO\CustomerCreateDTO;
use TenantCloud\TenantTurner\Customers\DTO\CustomerDTO;
use TenantCloud\TenantTurner\Customers\DTO\RefreshedApiKeyDTO;
use TenantCloud\TenantTurner\Customers\DTO\StatusDTO;
use TenantCloud\TenantTurner\Customers\Enum\TenantCloudAccountTypeEnum;

class FakeCustomersApi implements CustomersApi
{
	public function __construct(private readonly Repository $cache) {}

	public function create(CustomerCreateDTO $customerDTO): CustomerCreatedDTO
	{
		$customerId = random_int(1, 100000);

		$this->cache->put(
			"customers.{$customerId}",
			$customerDTO->toArray()
		);

		return CustomerCreatedDTO::create()
			->setCustomerId($customerId)
			->setListingEmail("leads+{$customerId}@tenantturnermail.com")
			->setApiKey(Str::random());
	}

	public function refreshApiKey(int $customerId, string $apiKey): RefreshedApiKeyDTO
	{
		return RefreshedApiKeyDTO::create()
			->setApiKey(Str::random());
	}

	public function status(int $customerId, ?string $fakeEmail = null): StatusDTO
	{
		if ($fakeEmail === 'subscribed_turner@tenantcloud.com') {
			return StatusDTO::create()
				->setTenantCloudAccountType(TenantCloudAccountTypeEnum::SUBSCRIPTION->value)
				->setListingPhone('188888888')
				->setManageLeadsInTenantTurner(null)
				->setTenantCloudAccountId($customerId);
		}

		if ($fakeEmail === 'listings+leads_turner@tenantcloud.com') {
			return StatusDTO::create()
				->setTenantCloudAccountType(TenantCloudAccountTypeEnum::LISTINGS->value)
				->setListingPhone('188888888')
				->setManageLeadsInTenantTurner(true)
				->setTenantCloudAccountId($customerId);
		}

		return StatusDTO::create()
			->setListingPhone('188888888')
			->setManageLeadsInTenantTurner(false)
			->setTenantCloudAccountType(TenantCloudAccountTypeEnum::LISTINGS->value)
			->setTenantCloudAccountId($customerId);
	}

	public function deactivate(int $customerId): void
	{
		// do nothing
	}

	public function get(string $email): CustomerDTO
	{
		return CustomerDTO::create()
			->setCustomerId(random_int(1, 100000))
			->setApiKey(Str::random());
	}
}
