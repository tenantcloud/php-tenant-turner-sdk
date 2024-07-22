<?php

namespace TenantCloud\TenantTurner\Properties\DTO\Responses;

use TenantCloud\DataTransferObjects\PascalDataTransferDTO;

/**
 * @method self        setPropertyId(int $propertyId)
 * @method int         getPropertyId()
 * @method bool        hasPropertyId()
 * @method self        setAddress(string $address)
 * @method string      getAddress()
 * @method bool        hasAddress()
 * @method self        setAddress2(string|null $address2)
 * @method string|null getAddress2()
 * @method bool        hasAddress2()
 * @method self        setCity(string $city)
 * @method string      getCity()
 * @method bool        hasCity()
 * @method self        setState(string $state)
 * @method string      getState()
 * @method bool        hasState()
 * @method self        setZipCode(string $zipCode)
 * @method string      getZipCode()
 * @method bool        hasZipCode()
 * @method self        setExternalId(string|null $externalId)
 * @method string|null getExternalId()
 * @method bool        hasExternalId()
 * @method self        setExternalSource(string|null $externalSource)
 * @method string|null getExternalSource()
 * @method bool        hasExternalSource()
 */
class PropertyDTO extends PascalDataTransferDTO
{
	protected array $fields = [
		'PropertyId',
		'Address',
		'Address2',
		'City',
		'State',
		'ZipCode',
		'ExternalId',
		'ExternalSource',
	];
}
