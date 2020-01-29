<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseholdPopulationBySex extends Model
{
    protected $fillable = [
    	'municipality',
		'female',
		'male',
		'year',
    ];
}
