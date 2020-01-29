<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HighValueCommercialCrop extends Model
{
    protected $fillable =[
    	'commodity',
		'farmers_served',
		'no_of_trees_planted',
		'planted_area',
		'production',
		'average_yield',
		'year'
    ];
}
