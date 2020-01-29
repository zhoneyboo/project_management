<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NonMetallicMineral extends Model
{
    protected $fillable = [
    	'municipality',
		'cubic_meter',
		'amount',
		'year',
    ];
}
