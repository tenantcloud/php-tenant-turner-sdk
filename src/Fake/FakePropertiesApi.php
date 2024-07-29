<?php

namespace TenantCloud\TenantTurner\Fake;

use Illuminate\Contracts\Cache\Repository;
use TenantCloud\TenantTurner\Exceptions\NotFoundException;
use TenantCloud\TenantTurner\Properties\DTO\PropertyDTO;
use TenantCloud\TenantTurner\Properties\DTO\Responses\SyncDTO;
use TenantCloud\TenantTurner\Properties\PropertiesApi;

class FakePropertiesApi implements PropertiesApi
{
	public function __construct(
		private readonly Repository $cache
	) {}

	public function create(string $userApiKey, PropertyDTO $propertyDTO): int
	{
		$id = random_int(1, PHP_INT_MAX);

		$this->cache->put(
			"{$userApiKey}:properties.{$id}",
			$propertyDTO->toArray()
		);

		return $id;
	}

	public function update(string $userApiKey, int $propertyId, PropertyDTO $propertyDTO): void
	{
		if (!$this->cache->has("{$userApiKey}:properties.{$propertyId}")) {
			throw new NotFoundException();
		}

		$this->cache->put(
			"{$userApiKey}:properties.{$propertyId}",
			$propertyDTO->toArray()
		);
	}

	public function sync(string $userApiKey): SyncDTO
	{
		return SyncDTO::create()->setData([]);
	}

	public function activate(string $userApiKey, int $propertyId): void
	{
		// do nothing
	}

	public function deactivate(string $userApiKey, int $propertyId): void
	{
		// do nothing
	}
}
