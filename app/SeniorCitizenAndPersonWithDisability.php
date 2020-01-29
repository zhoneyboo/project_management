<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeniorCitizenAndPersonWithDisability extends Model
{
    protected $fillable = [
    	'municipality',
		'senior_male',
		'senior_female',
		'disability_male',
		'disability_female',
		'year',
    ];
}
