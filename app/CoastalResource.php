<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoastalResource extends Model
{
    protected $fillable = [
    	'municipality',
		'municipal_water',
		'mpa',
		'mpa_percent',
        'year'
    ];


    public static function municipality(){
    	$district = [1,2,3,4,5,7,9,10,11,12,13,14,15];
    	return $district;
    }
}
