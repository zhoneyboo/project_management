<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonnelByStatus extends Model
{
    protected $fillable = [
    	'permanent_first_male',
		'permanent_first_female',
		'permanent_second_male',
		'permanent_second_female',
		'co_terminous_first_male',
		'co_terminous_first_female',
		'co_terminous_second_male',
		'co_terminous_second_female',
		'elective_male',
		'elective_female',
		'year',
    ];
}
