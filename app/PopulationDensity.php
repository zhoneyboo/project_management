<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopulationDensity extends Model
{
   protected $fillable = [
   	'population_density_infos_id',
   	'municipality',
	'gross_old',
	'gross_actual',
	'urban_old',
	'urban_actual',
	'estimated_gross',
   ];
}
