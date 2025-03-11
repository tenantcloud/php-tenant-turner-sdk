<?php

namespace TenantCloud\TenantTurner\Fake;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use TenantCloud\TenantTurner\Customers\CustomersApi;
use TenantCloud\TenantTurner\Customers\DTO\CustomerCreatedDTO;
use TenantCloud\TenantTurner\Customers\DTO\CustomerCreateDTO;
use TenantCloud\TenantTurner\Customers\DTO\RefreshedApiKeyDTO;
use TenantCloud\TenantTurner\Customers\DTO\StatusDTO;
use TenantCloud\TenantTurner\Customers\Enum\TenantCloudAccountTypeEnum;

class FakeCustomersApi implements CustomersApi
{
	public function __construct(
		private readonly Repository $cache
	) {}

	public function create(CustomerCreateDTO $customerDTO): CustomerCreatedDTO
	{
		$customerId = random_int(1, PHP_INT_MAX);

		$this->cache->put(
			"customers.{$customerId}",
			$customerDTO->toArray()
		);

		return CustomerCreatedDTO::create()
			->setCustomerId($customerId)
			->setListingPhone('1800' . random_int(1111111, 9999999))
			->setListingEmail("leads+{$customerId}@tenantturnermail.com")
			->setApiKey(Str::random());
	}

	public function refreshApiKey(int $customerId, string $apiKey): RefreshedApiKeyDTO
	{
		return RefreshedApiKeyDTO::create()
			->setApiKey(Str::random());
	}

	public function status(int $customerId): StatusDTO
	{
		$customer = $this->cache->get("customers.{$customerId}");

		if ($customer && Arr::get($customer, 'Email') === 'subscribed_turner@tenantcloud.com') {
			return StatusDTO::create()
				->setTenantCloudAccountType(TenantCloudAccountTypeEnum::SUBSCRIPTION->value)
				->setIsActive(true)
				->setManageLeadsInTenantTurner(true)
				->setTenantCloudAccountId($customerId);
		}

		if ($customer && Arr::get($customer, 'Email') === 'listings+leads_turner@tenantcloud.com') {
			return StatusDTO::create()
				->setTenantCloudAccountType(TenantCloudAccountTypeEnum::LISTINGS->value)
				->setIsActive(true)
				->setManageLeadsInTenantTurner(true)
				->setTenantCloudAccountId($customerId);
		}

		return StatusDTO::create()
			->setIsActive(true)
			->setManageLeadsInTenantTurner(false)
			->setTenantCloudAccountType(TenantCloudAccountTypeEnum::LISTINGS->value)
			->setTenantCloudAccountId($customerId);
	}

	public function deactivate(int $customerId): void
	{
		// do nothing
	}
}
