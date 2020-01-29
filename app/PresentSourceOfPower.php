<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresentSourceOfPower extends Model
{
    protected $fillable = [
    	'power_plant',
		'installed_capacity',
		'dependable_capacity',
		'municipality',
		'year',
    ];
}
