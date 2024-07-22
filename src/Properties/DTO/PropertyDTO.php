<?php

namespace TenantCloud\TenantTurner\Properties\DTO;

use Carbon\Carbon;
use TenantCloud\DataTransferObjects\PascalDataTransferDTO;
use TenantCloud\TenantTurner\Exceptions\InvalidArgumentException;
use TenantCloud\TenantTurner\Properties\Enum\CommunityEnum;
use TenantCloud\TenantTurner\Properties\Enum\MinimumLeaseTermEnum;
use TenantCloud\TenantTurner\Properties\Enum\PropertyAmenitiesEnum;
use TenantCloud\TenantTurner\Properties\Enum\PropertyTypeEnum;

/**
 * @method self                     setAddress(string $address)
 * @method string                   getAddress()
 * @method bool                     hasAddress()
 * @method self                     setAddress2(string|null $address)
 * @method string|null              getAddress2()
 * @method bool                     hasAddress2()
 * @method self                     setCity(string $city)
 * @method string                   getCity()
 * @method bool                     hasCity()
 * @method self                     setState(string $state)
 * @method string                   getState()
 * @method bool                     hasState()
 * @method self                     setZipCode(string $zipCode)
 * @method string                   getZipCode()
 * @method bool                     hasZipCode()
 * @method string                   getPropertyType()
 * @method bool                     hasPropertyType()
 * @method string|null              getCommunity()
 * @method bool                     hasCommunity()
 * @method self                     setAssignedUserEmail(string|null $assignedUserEmail)
 * @method string|null              getAssignedUserEmail()
 * @method bool                     hasAssignedUserEmail()
 * @method self                     setSquareFootage(int $squareFootage)
 * @method int                      getSquareFootage()
 * @method bool                     hasSquareFootage()
 * @method self                     setBedrooms(int $bedrooms)
 * @method int                      getBedrooms()
 * @method bool                     hasBedrooms()
 * @method self                     setBathrooms(string $bathrooms)
 * @method string                   getBathrooms()
 * @method bool                     hasBathrooms()
 * @method self                     setRentAmount(float $rentAmount)
 * @method float                    getRentAmount()
 * @method bool                     hasRentAmount()
 * @method self                     setDepositAmount(float $depositAmount)
 * @method float                    getDepositAmount()
 * @method bool                     hasDepositAmount()
 * @method self                     setApplicationFee(float|null $applicationFee)
 * @method float|null               getApplicationFee()
 * @method bool                     hasApplicationFee()
 * @method self                     setLeaseProcessingFee(float|null $leaseProcessingFee)
 * @method float|null               getLeaseProcessingFee()
 * @method bool                     hasLeaseProcessingFee()
 * @method self                     setDescription(string $description)
 * @method string                   getDescription()
 * @method bool                     hasDescription()
 * @method Carbon|null              getDateAvailable()
 * @method bool                     hasDateAvailable()
 * @method string|null              getMinimumLeaseTerm()
 * @method bool                     hasMinimumLeaseTerm()
 * @method self                     setVirtualTour(string|null $virtualTour)
 * @method string|null              getVirtualTour()
 * @method bool                     hasVirtualTour()
 * @method self                     setApplicationUrl(string|null $applicationUrl)
 * @method string|null              getApplicationUrl()
 * @method bool                     hasApplicationUrl()
 * @method array                    getPhotos()
 * @method bool                     hasPhotos()
 * @method array|null               getOccupants()
 * @method bool                     hasOccupants()
 * @method array|null               getOwners()
 * @method bool                     hasOwners()
 * @method PropertyFeaturesDTO|null getPropertyFeatures()
 * @method bool                     hasPropertyFeatures()
 * @method array|null               getPropertyAmenities()
 * @method bool                     hasPropertyAmenities()
 */
class PropertyDTO extends PascalDataTransferDTO
{
	protected array $fields = [
		'Address',
		'Address2',
		'City',
		'State',
		'ZipCode',
		'PropertyType',
		'Community',
		'AssignedUserEmail',
		'SquareFootage',
		'Bedrooms',
		'Bathrooms',
		'RentAmount',
		'DepositAmount',
		'ApplicationFee',
		'LeaseProcessingFee',
		'Description',
		'DateAvailable',
		'MinimumLeaseTerm',
		'VirtualTour',
		'ApplicationUrl',
		'Photos',
		'Occupants',
		'Owners',
		'PropertyFeatures',
		'PropertyAmenities',
	];

	public function setPropertyType(PropertyTypeEnum $propertyType): self
	{
		return $this->set('PropertyType', $propertyType->value);
	}

	public function setCommunity(?CommunityEnum $community): self
	{
		if (!$community) {
			return $this->set('Community', null);
		}

		return $this->set('Community', $community->value);
	}

	public function setDateAvailable(Carbon|string|null $dateAvailable): self
	{
		if (!$dateAvailable) {
			return $this->set('DateAvailable', null);
		}

		return $this->set('DateAvailable', Carbon::parse($dateAvailable));
	}

	public function setMinimumLeaseTerm(?MinimumLeaseTermEnum $minimumLeaseTerm): self
	{
		if (!$minimumLeaseTerm) {
			return $this->set('MinimumLeaseTerm', null);
		}

		return $this->set('MinimumLeaseTerm', $minimumLeaseTerm->value);
	}

	public function setPhotos(?array $photos): self
	{
		if (!$photos) {
			return $this->set('Photos', null);
		}

		$result = array_map(fn ($item) => PhotosDTO::from($item), $photos);

		return $this->set('Photos', $result);
	}

	public function setOccupants(?array $occupants): self
	{
		if (!$occupants) {
			return $this->set('Occupants', null);
		}

		$result = array_map(fn ($item) => OccupantsDTO::from($item), $occupants);

		return $this->set('Occupants', $result);
	}

	public function setOwners(?array $owners): self
	{
		if (!$owners) {
			return $this->set('Owners', null);
		}

		$result = array_map(fn ($item) => OwnersDTO::from($item), $owners);

		return $this->set('Owners', $result);
	}

	public function setPropertyFeatures(array|PropertyFeaturesDTO|null $propertyFeatures): self
	{
		if (!$propertyFeatures) {
			return $this->set('PropertyFeatures', null);
		}

		if ($propertyFeatures 	instanceof PropertyFeaturesDTO) {
			return $this->set('PropertyFeatures', $propertyFeatures);
		}

		return $this->set('PropertyFeatures', PropertyFeaturesDTO::from($propertyFeatures));
	}

	public function setPropertyAmenities(?array $propertyAmenities): self
	{
		if (!$propertyAmenities) {
			return $this->set('PropertyAmenities', []);
		}

		foreach ($propertyAmenities as $key => $amenity) {
			if (!$amenity instanceof PropertyAmenitiesEnum) {
				throw new InvalidArgumentException('PropertyAmenities must be instance of PropertyAmenitiesEnum::class');
			}

			$propertyAmenities[$key] = $amenity->value;
		}

		return $this->set('PropertyAmenities', $propertyAmenities);
	}
}
