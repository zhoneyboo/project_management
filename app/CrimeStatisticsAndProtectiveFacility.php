<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrimeStatisticsAndProtectiveFacility extends Model
{
    protected $fillable = [
    	'group_crime',
		'crime',
		'number',
		'year',
    ];
}
