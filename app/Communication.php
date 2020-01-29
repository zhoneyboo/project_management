<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    protected $fillable = [
    	'municipality',
		'smart_communication',
		'globe_telecom',
		'year',
    ];
}
