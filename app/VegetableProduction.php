<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VegetableProduction extends Model
{
    protected $fillable = [
    	'commodity',
		'area_harvested',
		'production_mt',
		'arerage_yield',
		'year',
    ];
}
