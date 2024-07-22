<?php

namespace Tests\Functional\Properties;

use TenantCloud\TenantTurner\Properties\DTO\PropertyDTO;
use TenantCloud\TenantTurner\Properties\DTO\Responses\PropertyDTO as ResponsePropertyDTO;
use TenantCloud\TenantTurner\Properties\DTO\Responses\SyncDTO;
use TenantCloud\TenantTurner\Properties\Enum\CommunityEnum;
use TenantCloud\TenantTurner\Properties\Enum\CoolingSystemEnum;
use TenantCloud\TenantTurner\Properties\Enum\HeatingSystemEnum;
use TenantCloud\TenantTurner\Properties\Enum\LaundryEnum;
use TenantCloud\TenantTurner\Properties\Enum\MinimumLeaseTermEnum;
use TenantCloud\TenantTurner\Properties\Enum\ParkingTypeEnum;
use TenantCloud\TenantTurner\Properties\Enum\PropertyAmenitiesEnum;
use TenantCloud\TenantTurner\Properties\Enum\PropertyTypeEnum;
use Tests\TestCase;

class PropertiesApiTest extends TestCase
{
	public function testCreatePropertySuccess(): void
	{
		$tenantTurnerClient = $this->mockResponse(
			201,
			file_get_contents(__DIR__ . '/../../resources/properties/create.json')
		);

		$propertyDto = $this->getFilledPropertyDto();

		$propertyId = $tenantTurnerClient->properties()->create('fake_api_key', $propertyDto);

		$this->assertSame(12345, $propertyId);
	}

	public function testUpdatePropertySuccess(): void
	{
		$this->expectNotToPerformAssertions();

		$tenantTurnerClient = $this->mockResponse(204);

		$propertyDto = $this->getFilledPropertyDto();

		$tenantTurnerClient->properties()->update('fake_api_key', 12345, $propertyDto);
	}

	public function testSyncPropertySuccess(): void
	{
		$tenantTurnerClient = $this->mockResponse(
			200,
			file_get_contents(__DIR__ . '/../../resources/properties/sync.json')
		);

		$sync = $tenantTurnerClient->properties()->sync('fake_api_key');

		$this->assertInstanceOf(SyncDTO::class, $sync);
		$this->assertCount(2, $sync->getData());

		$this->assertInstanceOf(ResponsePropertyDTO::class, $sync->getData()[0]);
		$this->assertSame(12345, $sync->getData()[0]->getPropertyId());

		$this->assertInstanceOf(ResponsePropertyDTO::class, $sync->getData()[1]);
		$this->assertSame(12346, $sync->getData()[1]->getPropertyId());
	}

	public function testSyncPropertyWithEmptyDataSuccess(): void
	{
		$tenantTurnerClient = $this->mockResponse(
			200,
			file_get_contents(__DIR__ . '/../../resources/properties/sync-empty-data.json')
		);

		$sync = $tenantTurnerClient->properties()->sync('fake_api_key');

		$this->assertInstanceOf(SyncDTO::class, $sync);
		$this->assertCount(0, $sync->getData());
	}

	public function testActivatePropertySuccess(): void
	{
		$this->expectNotToPerformAssertions();

		$tenantTurnerClient = $this->mockResponse(204);

		$tenantTurnerClient->properties()->activate('fake_api_key', 12345);
	}

	public function testDeactivatePropertySuccess(): void
	{
		$this->expectNotToPerformAssertions();

		$tenantTurnerClient = $this->mockResponse(204);

		$tenantTurnerClient->properties()->deactivate('fake_api_key', 12345);
	}

	private function getFilledPropertyDto(): PropertyDTO
	{
		return PropertyDTO::from([
			'Address'            => '123 Main St',
			'Address2'           => '456 Extra St',
			'City'               => 'Richmond',
			'State'              => 'VA',
			'ZipCode'            => '23235',
			'PropertyType'       => PropertyTypeEnum::APARTMENT_UNIT,
			'Community'          => CommunityEnum::ASSOCIATIONS,
			'AssignedUserEmail'  => 'jim@pmco.com',
			'SquareFootage'      => 3000,
			'Bedrooms'           => 4,
			'Bathrooms'          => 4,
			'RentAmount'         => 2500.00,
			'DepositAmount'      => 2500.00,
			'ApplicationFee'     => 60.00,
			'LeaseProcessingFee' => 30.00,
			'Description'        => 'Much amazing, such wow!',
			'DateAvailable'      => '2023-10-01T00:00:00.000',
			'MinimumLeaseTerm'   => MinimumLeaseTermEnum::MONTHLY,
			'VirtualTour'        => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
			'ApplicationUrl'     => 'https://www.greatestpmco.com/apply-123-main-st',
			'Photos'             => [
				[
					'Url'   => 'https://montrealfilmjournal.com/wp-content/uploads/2020/02/R0001226.jpg',
					'Order' => 1,
				],
			],
			'Occupants' => [
				[
					'Phone' => '18045558877',
					'Email' => 'john@doe.com',
				],
			],
			'Owners' => [
				[
					'Email' => 'owner@co.com',
				],
			],
			'PropertyFeatures' => [
				'Laundry'                 => LaundryEnum::IN_UNIT,
				'ParkingType'             => ParkingTypeEnum::GARAGE_DETACHED,
				'ParkingCount'            => 2,
				'CoolingSystem'           => CoolingSystemEnum::EVAPORATIVE,
				'HeatingSystem'           => HeatingSystemEnum::NONE,
				'RentIncludesTrash'       => true,
				'RentIncludesWater'       => true,
				'RentIncludesElectricity' => false,
				'RentIncludesGas'         => false,
				'RentIncludesCable'       => false,
				'RentIncludesInternet'    => false,
			],
			'PropertyAmenities' => [
				PropertyAmenitiesEnum::BALCONY, PropertyAmenitiesEnum::DECK, PropertyAmenitiesEnum::HARDWOOD_FLOORING,
			],
		]);
	}
}
