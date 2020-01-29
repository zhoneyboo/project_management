<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseholdPopulationBySourceOfDrinkingWater extends Model
{
    protected $fillable = [
    	'source_of_drinking',
		'magnitude',
		'proportion',
		'year',
    ];
}
