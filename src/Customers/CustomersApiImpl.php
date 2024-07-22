<?php

namespace TenantCloud\TenantTurner\Customers;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use TenantCloud\TenantTurner\Client\RequestHelper;
use TenantCloud\TenantTurner\Customers\DTO\CustomerCreatedDTO;
use TenantCloud\TenantTurner\Customers\DTO\CustomerDTO;

use function TenantCloud\GuzzleHelper\psr_response_to_json;

class CustomersApiImpl implements CustomersApi
{
	use RequestHelper;

	private const CREATE_CUSTOMER_API = '/v1/customers';
	private const DEACTIVATE_CUSTOMER_API = '/v1/customers/%s';

	public function __construct(
		private readonly string $apiKey,
		private readonly Client $httpClient,
	) {}

	public function create(CustomerDTO $customerDTO): CustomerCreatedDTO
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
