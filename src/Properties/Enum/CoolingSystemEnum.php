<?php

namespace TenantCloud\TenantTurner\Properties\Enum;

enum CoolingSystemEnum: string
{
	case NONE = 'None';
	case CENTRAL_AIR = 'Central Air';
	case EVAPORATIVE = 'Evaporative';
	case GEOTHERMAL = 'Geothermal';
	case WALL = 'Wall';
	case SOLAR = 'Solar';
	case OTHER = 'Other';
}
