<?php

namespace TenantCloud\TenantTurner\Properties\Enum;

enum ParkingTypeEnum: string
{
	case NONE = 'None';
	case CARPORT = 'Carport';
	case GARAGE_ATTACHED = 'Garage Attached';
	case GARAGE_DETACHED = 'Garage Detached';
	case OFF_STREET = 'Off-Street';
	case ON_STREET = 'On-Street';
}
