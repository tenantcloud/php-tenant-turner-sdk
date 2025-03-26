<?php

namespace TenantCloud\TenantTurner\Customers\DTO;

use TenantCloud\DataTransferObjects\PascalDataTransferDTO;

/**
 * @method self   setCustomerId(int $customerId)
 * @method int    getCustomerId()
 * @method bool   hasCustomerId()
 * @method self   setApiKey(string $apiKey)
 * @method string getApiKey()
 * @method bool   hasApiKey()
 */
class CustomerDTO extends PascalDataTransferDTO
{
	protected array $fields = [
		'CustomerId',
		'ApiKey',
	];
}
