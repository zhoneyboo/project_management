<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisteredVehicle extends Model
{
    protected $fillable = [
    	'cars',
		'suv_uv',
		'tricycle',
		'truck',
		'truck_bus',
		'motorcycle',
		'uv_jeep',
		'month',
		'year',
    ];

    public function getMonthAttribute($value)
    {
 		return date("F", mktime(0, 0, 0, $value, 10));
    }
    
}
