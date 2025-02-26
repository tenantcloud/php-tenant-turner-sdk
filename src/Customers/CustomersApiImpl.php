<?php

namespace TenantCloud\TenantTurner\Customers;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use TenantCloud\TenantTurner\Client\RequestHelper;
use TenantCloud\TenantTurner\Customers\DTO\CustomerCreatedDTO;
use TenantCloud\TenantTurner\Customers\DTO\CustomerCreateDTO;
use TenantCloud\TenantTurner\Customers\DTO\RefreshedApiKeyDTO;
use TenantCloud\TenantTurner\Customers\DTO\StatusDTO;

use function TenantCloud\GuzzleHelper\psr_response_to_json;

class CustomersApiImpl implements CustomersApi
{
	use RequestHelper;

	private const CREATE_CUSTOMER_API = '/v1/customers';
	private const REFRESH_API_KEY = '/v1/customers/%s/refresh-api-key';
	private const DEACTIVATE_CUSTOMER_API = '/v1/customers/%s';
	private const STATUS_API = '/v1/customers/%s/status';

	public function __construct(
		private readonly string $apiKey,
		private readonly Client $httpClient,
	) {}

	public function create(CustomerCreateDTO $customerDTO): CustomerCreatedDTO
	{
		$jsonResponse = $this->httpClient->post(
			self::CREATE_CUSTOMER_API,
			[
				RequestOptions::HEADERS => $this->setAuthHeader($this->apiKey),
				RequestOptions::JSON    => $customerDTO->toArray(),
			]
		);

		$response = psr_response_to_json($jsonResponse);

		return CustomerCreatedDTO::from($response);
	}

	public function refreshApiKey(int $customerId, string $apiKey): RefreshedApiKeyDTO
	{
		$jsonResponse = $this->httpClient->post(
			sprintf(self::REFRESH_API_KEY, $customerId),
			[
				RequestOptions::HEADERS => $this->setAuthHeader($this->apiKey),
				RequestOptions::JSON    => ['ApiKey' => $apiKey],
			]
		);

		$response = psr_response_to_json($jsonResponse);

		return RefreshedApiKeyDTO::from($response);
	}

	public function status(int $customerId): StatusDTO
	{
		$jsonResponse = $this->httpClient->get(
			sprintf(self::STATUS_API, $customerId),
			[
				RequestOptions::HEADERS => $this->setAuthHeader($this->apiKey),
			]
		);

		$response = psr_response_to_json($jsonResponse);

		return StatusDTO::from($response);
	}

	public function deactivate(int $customerId): void
	{
		$this->httpClient->delete(
			sprintf(self::DEACTIVATE_CUSTOMER_API, $customerId),
			[
				RequestOptions::HEADERS => $this->setAuthHeader($this->apiKey),
			]
		);
	}
}
