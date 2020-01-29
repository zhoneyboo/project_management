<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NutritionalStatus extends Model
{
    protected $fillable = [
    	'age_range',
		'normal_boys',
		'normal_girls',
		'underweight_boys',
		'underweight_girls',
		'severely_boys',
		'severely_girls',
		'overweight_boys',
		'overweight_girls',
		'year',
    ];
}
