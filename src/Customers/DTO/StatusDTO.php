<?php

namespace TenantCloud\TenantTurner\Customers\DTO;

use TenantCloud\DataTransferObjects\PascalDataTransferDTO;

/**
 * @method self   setTenantCloudAccountId(int $tenantCloudAccountId)
 * @method int    getTenantCloudAccountId()
 * @method bool   hasTenantCloudAccountId()
 * @method self   setTenantCloudAccountType(string $tenantCloudAccountType)
 * @method string getTenantCloudAccountType()
 * @method bool   hasTenantCloudAccountType()
 * @method self   setManageLeadsInTenantTurner(bool $manageLeadsInTenantTurner)
 * @method bool   getManageLeadsInTenantTurner()
 * @method bool   hasManageLeadsInTenantTurner()
 * @method self   setIsActive(bool $isActive)
 * @method bool   getIsActive()
 * @method bool   hasIsActive()
 */
class StatusDTO extends PascalDataTransferDTO
{
	protected array $fields = [
		"TenantCloudAccountId",
		"TenantCloudAccountType",
		"ManageLeadsInTenantTurner",
		"IsActive",
	];
}
