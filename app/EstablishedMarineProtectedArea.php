<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstablishedMarineProtectedArea extends Model
{
    protected $fillable = [
    	'municipality',
		'name_of_mpa',
		'location',
		'year_stablished',
		'estimated_area',
		'year',
    ];
}
