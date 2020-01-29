<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComparativeLaborForce extends Model
{
    protected $fillable = [
    	'labor_employment',
		'rate',
		'year',
    ];
}
