<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TouristSitesAndDestination extends Model
{
    protected $fillable = [
    	'municipality',
		'destination',
    ];
}
