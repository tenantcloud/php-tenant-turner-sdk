<?php

namespace Tests\Functional\Customers;

use TenantCloud\TenantTurner\Customers\DTO\CustomerCreatedDTO;
use TenantCloud\TenantTurner\Customers\DTO\CustomerDTO;
use TenantCloud\TenantTurner\Customers\Enum\CountryEnum;
use TenantCloud\TenantTurner\Customers\Enum\TimezoneEnum;
use Tests\TestCase;

class CustomersApiTest extends TestCase
{
	public function testCreateCustomerSuccess(): void
	{
		$tenantTurnerClient = $this->mockResponse(
			201,
			file_get_contents(__DIR__ . '/../../resources/customers/create.json')
		);

		$customerDto = $this->getFilledCustomerDto();

		$createdCustomerDto = $tenantTurnerClient->customers()->create($customerDto);

		$this->assertInstanceOf(CustomerCreatedDTO::class, $createdCustomerDto);
		$this->assertSame(67890, $createdCustomerDto->getCustomerId());
		$this->assertSame('leads+67890@tenantturnermail.com', $createdCustomerDto->getListingEmail());
		$this->assertSame('555-123-4567', $createdCustomerDto->getListingPhone());
		$this->assertSame('q23c9r480tnyqc234nv9807yq324vn89cy0t', $createdCustomerDto->getApiKey());
	}

	public function testDeactivateCustomerSuccess()
	{
		$this->expectNotToPerformAssertions();

		$tenantTurnerClient = $this->mockResponse(204);

		$tenantTurnerClient->customers()->deactivate(12345);
	}

	public function getFilledCustomerDto(): CustomerDTO
	{
		return CustomerDTO::from([
			'TenantCloudAccountId' => 12350,
			'CompanyName'          => 'New Co',
			'UserFirstName'        => 'John',
			'UserLastName'         => 'Doe',
			'Email'                => 'john.doe@gmail.com',
			'Phone'                => '18045556789',
			'Timezone'             => TimezoneEnum::EASTERN_STANDARD_TIME,
			'Address1'             => '4820 Lake Brook Dr',
			'Address2'             => null,
			'City'                 => 'Glen Allen',
			'State'                => 'VA',
			'PostalCode'           => '23060',
			'Country'              => CountryEnum::US,
		]);
	}
}
