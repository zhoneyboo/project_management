<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralInformation extends Model
{
    protected $fillable = [
    	'location',
		'topography',
		'land_area',
		'boundary',
		'climate',
		'capital',
		'date_of_approval',
		'legal_basis',
		'no_of_component_city',
		'no_of_municipality',
		'no_of_congressional_district',
		'no_of_barangay',
		'year',
    ];
}
