<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class PopulationDensityInfo extends Model
{
    protected $fillable = [
    	'old_year',
		'actual_year',
		'estimated',
    ];
}
