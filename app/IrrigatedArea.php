<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IrrigatedArea extends Model
{
    protected $fillable = [
    	'municipality',
		'ris',
		'cis',
		'pump',
		'total',
		'year',
    ];
}
