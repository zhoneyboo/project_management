<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PovertyIncidence extends Model
{
    protected $fillable = [
    	'municipality',
		'poverty_incidence',
		'year',
    ];
}
