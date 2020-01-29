<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaterSystem extends Model
{
	protected $fillable = [
		'municipality',
		'water_service_provider',
		'type_of_water_facility',
		'year',
	];
    //
}
