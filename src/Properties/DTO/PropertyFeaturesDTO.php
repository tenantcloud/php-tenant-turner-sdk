<?php

namespace TenantCloud\TenantTurner\Properties\DTO;

use TenantCloud\DataTransferObjects\PascalDataTransferDTO;
use TenantCloud\TenantTurner\Properties\Enum\CoolingSystemEnum;
use TenantCloud\TenantTurner\Properties\Enum\HeatingSystemEnum;
use TenantCloud\TenantTurner\Properties\Enum\LaundryEnum;
use TenantCloud\TenantTurner\Properties\Enum\ParkingTypeEnum;

/**
 * @method string|null getLaundry()
 * @method bool        hasLaundry()
 * @method string|null getParkingType()
 * @method bool        hasParkingType()
 * @method self        setParkingCount(int|null $parkingCount)
 * @method int|null    getParkingCount()
 * @method bool        hasParkingCount()
 * @method string|null getCoolingSystem()
 * @method bool        hasCoolingSystem()
 * @method string|null getHeatingSystem()
 * @method bool        hasHeatingSystem()
 * @method self        setRentIncludesTrash(bool|null $rentIncludedTrash)
 * @method bool|null   getRentIncludesTrash()
 * @method bool        hasRentIncludesTrash()
 * @method self        setRentIncludesWater(bool|null $rentIncludesWater)
 * @method bool|null   getRentIncludesWater()
 * @method bool        hasRentIncludesWater()
 * @method self        setRentIncludesElectricity(bool|null $rentIncludesElectricity)
 * @method bool|null   getRentIncludesElectricity()
 * @method bool        hasRentIncludesElectricity()
 * @method self        setRentIncludesGas(bool|null $rentIncludesGas)
 * @method bool|null   getRentIncludesGas()
 * @method bool        hasRentIncludesGas()
 * @method self        setRentIncludesCable(bool|null $rentIncludesCable)
 * @method bool|null   getRentIncludesCable()
 * @method bool        hasRentIncludesCable()
 * @method self        setRentIncludesInternet(bool|null $rentIncludesInternet)
 * @method bool|null   getRentIncludesInternet()
 * @method bool        hasRentIncludesInternet()
 */
class PropertyFeaturesDTO extends PascalDataTransferDTO
{
	protected array $fields = [
		'Laundry',
		'ParkingType',
		'ParkingCount',
		'CoolingSystem',
		'HeatingSystem',
		'RentIncludesTrash',
		'RentIncludesWater',
		'RentIncludesElectricity',
		'RentIncludesGas',
		'RentIncludesCable',
		'RentIncludesInternet',
	];

	public function setLaundry(?LaundryEnum $laundry): self
	{
		if (!$laundry) {
			return $this->set('Laundry', null);
		}

		return $this->set('Laundry', $laundry->value);
	}

	public function setParkingType(?ParkingTypeEnum $parkingType): self
	{
		if (!$parkingType) {
			return $this->set('ParkingType', null);
		}

		return $this->set('ParkingType', $parkingType->value);
	}

	public function setCoolingSystem(?CoolingSystemEnum $coolingSystem): self
	{
		if (!$coolingSystem) {
			return $this->set('CoolingSystem', null);
		}

		return $this->set('CoolingSystem', $coolingSystem->value);
	}

	public function setHeatingSystem(?HeatingSystemEnum $heatingSystem): self
	{
		if (!$heatingSystem) {
			return $this->set('HeatingSystem', null);
		}

		return $this->set('HeatingSystem', $heatingSystem->value);
	}
}
