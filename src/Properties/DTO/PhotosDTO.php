<?php

namespace TenantCloud\TenantTurner\Properties\DTO;

use TenantCloud\DataTransferObjects\PascalDataTransferDTO;

/**
 * @method self   setUrl(string $url)
 * @method string getUrl()
 * @method bool   hasUrl()
 * @method self   setOrder(int $order)
 * @method int    getOrder()
 * @method bool   hasOrder()
 */
class PhotosDTO extends PascalDataTransferDTO
{
	protected array $fields = [
		'Url',
		'Order',
	];
}
