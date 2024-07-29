<?php

namespace TenantCloud\TenantTurner\Fake;

use Illuminate\Contracts\Cache\Repository;
use TenantCloud\TenantTurner\Client\TenantTurnerClient;
use TenantCloud\TenantTurner\Customers\CustomersApi;
use TenantCloud\TenantTurner\Properties\PropertiesApi;

class FakeTenantTurnerClient implements TenantTurnerClient
{
	private readonly FakePropertiesApi $propertiesApi;

	private readonly FakeCustomersApi $customersApi;

	public function __construct(Repository $cache)
	{
		$this->propertiesApi = new FakePropertiesApi($cache);
		$this->customersApi = new FakeCustomersApi($cache);
	}

	public function properties(): PropertiesApi
	{
		return $this->propertiesApi;
	}

	public function customers(): CustomersApi
	{
		return $this->customersApi;
	}
}
