<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NumberRateBdimd extends Model
{
    protected $fillable = [
    	'indicator',
		'number',
		'rate',
		'year',
    ];
}
