<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeographicalZoneSurfaces extends Model
{
    //

    protected $fillable = [
    	'coastal_area',
		'lake_areas',
		'total_land_mass',
		'year',
    ];

    
}
