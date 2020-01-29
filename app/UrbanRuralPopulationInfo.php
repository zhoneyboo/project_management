<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrbanRuralPopulationInfo extends Model
{
    protected $fillable = [
    	'population_year_1',
		'population_year_2',
		'year_of_encoding',
    ];
}
