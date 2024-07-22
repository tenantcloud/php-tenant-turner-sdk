<?php

namespace TenantCloud\TenantTurner\Customers\DTO;

use TenantCloud\DataTransferObjects\PascalDataTransferDTO;
use TenantCloud\TenantTurner\Customers\Enum\CountryEnum;
use TenantCloud\TenantTurner\Customers\Enum\TimezoneEnum;

/**
 * @method self        setTenantCloudAccountId(int $tenantCloudAccountId)
 * @method int         getTenantCloudAccountId()
 * @method bool        hasTenantCloudAccountId()
 * @method self        setCompanyName(string $companyName)
 * @method string      getCompanyName()
 * @method bool        hasCompanyName()
 * @method self        setUserFirstName(string $userFirstName)
 * @method string      getUserFirstName()
 * @method bool        hasUserFirstName()
 * @method self        setUserLastName(string $userLastName)
 * @method string      getUserLastName()
 * @method bool        hasUserLastName()
 * @method self        setEmail(string $email)
 * @method string      getEmail()
 * @method bool        hasEmail()
 * @method self        setPhone(string $phone)
 * @method string      getPhone()
 * @method bool        hasPhone()
 * @method string      getTimezone()
 * @method bool        hasTimezone()
 * @method self        setAddress1(string $address1)
 * @method string      getAddress1()
 * @method bool        hasAddress1()
 * @method self        setAddress2(string|null $address2)
 * @method string|null getAddress2()
 * @method bool        hasAddress2()
 * @method self        setCity(string $city)
 * @method string      getCity()
 * @method bool        hasCity()
 * @method self        setState(string $state)
 * @method string      getState()
 * @method bool        hasState()
 * @method self        setPostalCode(string $postalCode)
 * @method string      getPostalCode()
 * @method bool        hasPostalCode()
 * @method string      getCountry()
 * @method bool        hasCountry()
 */
class CustomerDTO extends PascalDataTransferDTO
{
	protected array $fields = [
		'TenantCloudAccountId',
		'CompanyName',
		'UserFirstName',
		'UserLastName',
		'Email',
		'Phone',
		'Timezone',
		'Address1',
		'Address2',
		'City',
		'State',
		'PostalCode',
		'Country',
	];

	public function setTimezone(TimezoneEnum $timezone): self
	{
		return $this->set('Timezone', $timezone->value);
	}

	public function setCountry(CountryEnum $country): self
	{
		return $this->set('Country', $country->value);
	}
}
