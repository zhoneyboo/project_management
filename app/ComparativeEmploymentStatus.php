<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComparativeEmploymentStatus extends Model
{
    protected $fillable = [
    	'labor_employment',
		'number',
		'year',
    ];
}
