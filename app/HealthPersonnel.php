<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthPersonnel extends Model
{
    protected $fillable = [
    	'personnel',
		'number',
		'year'
    ];
}
