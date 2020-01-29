<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthFacility extends Model
{
    protected $fillable = [
    	'facility',
		'number',
		'year'
    ];
}
