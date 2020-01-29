<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopulationByCensusYear extends Model
{
    protected $fillable = [
    	'municipality',
		'population',
		'year',
    ];
}
