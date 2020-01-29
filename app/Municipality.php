<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $fillable = [
    	'municipality',
		'district',
		'psgc',
    ];

    public static function with_watershed(){
    	$district = [1,2,3,4,5,7,9,10,11,12,13,14,15];
    	return Municipality::whereIn('id', $district)->get();
    }


}
