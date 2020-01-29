<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActualProjectedInfo extends Model
{
    protected $fillable = [
    	'old_year',
		'actual_year',
		'projected_year',
		'growth_rate_1',
		'growth_rate_2',
    ];
}
