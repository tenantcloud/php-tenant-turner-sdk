<?php

namespace TenantCloud\TenantTurner\Customers\DTO;

use TenantCloud\DataTransferObjects\PascalDataTransferDTO;

/**
 * @method self   setCustomerId(int $customerId)
 * @method int    getCustomerId()
 * @method bool   hasCustomerId()
 * @method self   setListingEmail(string $listingEmail)
 * @method string getListingEmail()
 * @method bool   hasListingEmail()
 * @method bool   hasListingPhone()
 * @method self   setApiKey(string $apiKey)
 * @method string getApiKey()
 * @method bool   hasApiKey()
 */
class CustomerCreatedDTO extends PascalDataTransferDTO
{
	protected array $fields = [
		'CustomerId',
		'ListingEmail',
		'ApiKey',
	];
}
