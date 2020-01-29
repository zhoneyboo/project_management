<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CornProduction extends Model
{
    protected $fillable = [
    	'municipality',
		'no_of_farmers',
		'area_harvested',
		'production_mt',
		'arerage_yield',
		'year',
    ];
}
