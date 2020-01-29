<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrbanRuralPopulation extends Model
{
    protected $fillable = [
    	'urban_rural_population_infos_id',
		'municipality',
		'no_of_barangays_urban',
		'no_of_barangays_rural',
		'population_urban_year_1',
		'population_rural_year_1',
		'population_urban_year_2',
		'population_rural_year_2',
    ];
}
