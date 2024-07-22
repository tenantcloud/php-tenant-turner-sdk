<?php

namespace TenantCloud\TenantTurner\Properties;

use TenantCloud\TenantTurner\Properties\DTO\PropertyDTO;
use TenantCloud\TenantTurner\Properties\DTO\Responses\SyncDTO;

interface PropertiesApi
{
	public function create(string $userApiKey, PropertyDTO $propertyDTO): int;

	public function update(string $userApiKey, int $propertyId, PropertyDTO $propertyDTO): void;

	public function sync(string $userApiKey): SyncDTO;

	public function activate(string $userApiKey, int $propertyId): void;

	public function deactivate(string $userApiKey, int $propertyId): void;
}
