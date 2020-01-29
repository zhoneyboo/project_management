<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccommodationEstablishment extends Model
{
    protected $fillable = [
    	'municipality',
		'no_of_accommodation_establishment',
		'no_of_room',
		'bedding_capacity',
		'total_employment',
		'year'
    ];
}
