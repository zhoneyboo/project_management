<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirePrevention extends Model
{
    protected $fillable = [
    	'municipality',
		'no_of_fire_station_bfp',
		'no_of_fire_station_lgu',
		'no_of_fire_trucks_bfp',
		'no_of_fire_trucks_lgu',
		'no_of_fire_trucks_ngo',
		'no_of_personnel',
		'year',
    ];
}
