<?php

namespace TenantCloud\TenantTurner\Client;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use TenantCloud\TenantTurner\Customers\CustomersApi;
use TenantCloud\TenantTurner\Customers\CustomersApiImpl;
use TenantCloud\TenantTurner\Properties\PropertiesApi;
use TenantCloud\TenantTurner\Properties\PropertiesApiImpl;

class TenantTurnerClientImpl implements TenantTurnerClient
{
	private readonly Client $httpClient;

	public function __construct(
		private readonly string $apiKey,
		string $baseUrl,
		int $timeout = 30,
		?Client $client = null,
	) {
		$this->httpClient = $client ?? new Client([
			'base_uri'                      => $baseUrl,
			RequestOptions::CONNECT_TIMEOUT => $timeout,
			RequestOptions::TIMEOUT         => $timeout,
		]);
	}

	public function properties(): PropertiesApi
	{
		return new PropertiesApiImpl($this->httpClient);
	}

	public function customers(): CustomersApi
	{
		return new CustomersApiImpl($this->apiKey, $this->httpClient);
	}
}
