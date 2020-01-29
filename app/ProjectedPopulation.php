<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectedPopulation extends Model
{
    protected $fillable = [
    	'projected_population_infos_id',
		'province',
		'actual_year_1',
		'actual_year_2',
		'growth_rate',
		'projection_year_1',
		'projection_year_2',
		'projection_year_3',
    ];
}
