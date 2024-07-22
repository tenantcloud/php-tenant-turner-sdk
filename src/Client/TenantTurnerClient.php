<?php

namespace TenantCloud\TenantTurner\Client;

use TenantCloud\TenantTurner\Customers\CustomersApi;
use TenantCloud\TenantTurner\Properties\PropertiesApi;

interface TenantTurnerClient
{
	public function properties(): PropertiesApi;

	public function customers(): CustomersApi;
}
