<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActualProjected extends Model
{
    protected $fillable = [
    	'actual_projected_infos_id',
		'municipality',
		'old_year_pop',
		'old_year_hh',
		'actual_year_pop',
		'actual_year_hh',
		'projected_year_pop',
		'projected_year_hh',
		'growth_rate_1',
		'growth_rate_2',
    ];
}
