<?php

namespace TenantCloud\TenantTurner\Properties\Enum;

enum HeatingSystemEnum: string
{
	case NONE = 'None';
	case BASEBOARD = 'Baseboard';
	case FORCED_AIR = 'Forced Air';
	case HEAT = 'Heat';
	case PUMP = 'Pump';
	case RADIANT = 'Radiant';
	case STOVE = 'Stove';
	case WALL = 'Wall';
	case OTHER = 'Other';
}
