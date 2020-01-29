<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthInfantMorbidity extends Model
{
    protected $fillable = [
    	'cause',
		'year_no',
		'year_rate',
		'five_year_no',
		'five_year_rate',
		'year',
    ];
}
