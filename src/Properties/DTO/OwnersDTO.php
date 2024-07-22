<?php

namespace TenantCloud\TenantTurner\Properties\DTO;

use TenantCloud\DataTransferObjects\PascalDataTransferDTO;

/**
 * @method self   setEmail(string $email)
 * @method string getEmail()
 * @method bool   hasEmail()
 */
class OwnersDTO extends PascalDataTransferDTO
{
	protected array $fields = [
		'Email',
	];
}
