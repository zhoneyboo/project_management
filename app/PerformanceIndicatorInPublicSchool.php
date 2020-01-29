<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceIndicatorInPublicSchool extends Model
{
    protected $fillable = [
    	'indicator',
		'province_elementary',
		'province_secondary',
		'calapan_elementary',
		'calapan_secondary',
		'year',
    ];
}
