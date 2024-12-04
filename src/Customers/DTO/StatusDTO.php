<?php

namespace TenantCloud\TenantTurner\Customers\DTO;

use TenantCloud\DataTransferObjects\PascalDataTransferDTO;

/**
 * @method self setIsActive(string $isActive)
 * @method bool getIsActive()
 * @method bool hasIsActive()
 */
class StatusDTO extends PascalDataTransferDTO
{
	protected array $fields = [
		'IsActive',
	];
}
