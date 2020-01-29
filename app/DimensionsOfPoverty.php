<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DimensionsOfPoverty extends Model
{
    protected $fillable = [
		'indicator',
		'household_magnitude',
		'household_proportion',
		'population_magnitude_total',
		'population_magnitude_male',
		'population_magnitude_female',
		'population_proportion_total',
		'population_proportion_male',
		'population_proportion_female',
		'year',
    ];

    
}
