<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PowerSubstation extends Model
{
    protected $fillable = [
    	'power_substation',
		'megavolt_amperes',
		'ownership',
		'year',
    ];
}
