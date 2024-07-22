<?php

namespace TenantCloud\TenantTurner\Properties;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use TenantCloud\TenantTurner\Client\RequestHelper;
use TenantCloud\TenantTurner\Properties\DTO\PropertyDTO;
use TenantCloud\TenantTurner\Properties\DTO\Responses\SyncDTO;

use function TenantCloud\GuzzleHelper\psr_response_to_json;

class PropertiesApiImpl implements PropertiesApi
{
	use RequestHelper;

	private const CREATE_PROPERTY_API = '/v1/properties';
	private const UPDATE_PROPERTY_API = '/v1/properties/%s';
	private const SYNC_PROPERTY_API = '/v1/properties/sync';
	private const ACTIVATE_PROPERTY_API = '/v1/properties/%s/activate';
	private const DEACTIVATE_PROPERTY_API = '/v1/properties/%s/deactivate';

	public function __construct(
		private readonly Client $httpClient,
	) {}

	public function create(string $userApiKey, PropertyDTO $propertyDTO): int
	{
		$jsonResponse = $this->httpClient->post(
			self::CREATE_PROPERTY_API,
			[
				RequestOptions::HEADERS => $this->setAuthHeader($userApiKey),
				RequestOptions::JSON    => $propertyDTO->toArray(),
			]
		);

		$response = psr_response_to_json($jsonResponse);

		return $response['PropertyId'];
	}

	public function update(string $userApiKey, int $propertyId, PropertyDTO $propertyDTO): void
	{
		$this->httpClient->put(
			sprintf(self::UPDATE_PROPERTY_API, $propertyId),
			[
				RequestOptions::HEADERS => $this->setAuthHeader($userApiKey),
				RequestOptions::JSON    => $propertyDTO->toArray(),
			]
		);
	}

	public function sync(string $userApiKey): SyncDTO
	{
		$jsonResponse = $this->httpClient->get(
			self::SYNC_PROPERTY_API,
			[
				RequestOptions::HEADERS => $this->setAuthHeader($userApiKey),
			]
		);

		$response = psr_response_to_json($jsonResponse);

		return SyncDTO::from($response);
	}

	public function activate(string $userApiKey, int $propertyId): void
	{
		$this->httpClient->put(
			sprintf(self::ACTIVATE_PROPERTY_API, $propertyId),
			[
				RequestOptions::HEADERS => $this->setAuthHeader($userApiKey),
			]
		);
	}

	public function deactivate(string $userApiKey, int $propertyId): void
	{
		$this->httpClient->put(
			sprintf(self::DEACTIVATE_PROPERTY_API, $propertyId),
			[
				RequestOptions::HEADERS => $this->setAuthHeader($userApiKey),
			]
		);
	}
}
