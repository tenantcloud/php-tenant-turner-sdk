<?php

namespace TenantCloud\TenantTurner\Properties\Enum;

enum PropertyTypeEnum: string
{
	case SINGLE_FAMILY = 'Single Family';
	case TOWNHOUSE = 'Townhouse';
	case CONDO_UNIT = 'Condo Unit';
	case APARTMENT_UNIT = 'Apartment Unit';
	case DUPLEX = 'Duplex';
	case APARTMENT_COMMUNITY = 'Apartment Community';
	case ROOM_FOR_RENT = 'Room for Rent';
	case OFFICE = 'Office';
}
