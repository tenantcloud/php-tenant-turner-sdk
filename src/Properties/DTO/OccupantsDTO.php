<?php

namespace TenantCloud\TenantTurner\Properties\DTO;

use TenantCloud\DataTransferObjects\PascalDataTransferDTO;

/**
 * @method self   setPhone(string $email)
 * @method string getPhone()
 * @method bool   hasPhone()
 * @method self   setEmail(string $email)
 * @method string getEmail()
 * @method bool   hasEmail()
 */
class OccupantsDTO extends PascalDataTransferDTO
{
	protected array $fields = [
		'Phone',
		'Email',
	];
}
