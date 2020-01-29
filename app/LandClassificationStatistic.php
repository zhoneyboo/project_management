<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandClassificationStatistic extends Model
{
    protected $fillable = [
    	'certified_alienable_and_disposable_land',
		'forest_land_classified',
		'forest_land_unclassified',
		'year'
    ];
}
