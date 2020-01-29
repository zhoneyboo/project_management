<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectedPopulationInfo extends Model
{
    protected $fillable = [
    	'actual_year_1',
		'actual_year_2',
		'growth_rate',
		'projection_year_1',
		'projection_year_2',
		'projection_year_3',
		'year_of_encoding',
    ];
}
