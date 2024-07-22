<?php

namespace TenantCloud\TenantTurner\Properties\DTO\Responses;

use TenantCloud\DataTransferObjects\PascalDataTransferDTO;

/**
 * @method list<PropertyDTO> getData()
 * @method bool              hasData()
 */
class SyncDTO extends PascalDataTransferDTO
{
	protected array $fields = [
		'Data',
	];

	public function setData(array $properties): self
	{
		return $this->set('Data', array_map(static fn (array $property) => PropertyDTO::from($property), $properties));
	}
}
