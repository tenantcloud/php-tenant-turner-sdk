<?php

namespace TenantCloud\TenantTurner\Customers\DTO;

use TenantCloud\DataTransferObjects\PascalDataTransferDTO;

/**
 * @method self   setApiKey(string $apiKey)
 * @method string getApiKey()
 * @method bool   hasApiKey()
 */
class RefreshedApiKeyDTO extends PascalDataTransferDTO
{
	protected array $fields = [
		'ApiKey',
	];
}
