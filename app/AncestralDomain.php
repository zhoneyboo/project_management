<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AncestralDomain extends Model
{
    protected $fillable = [
    	'name_address',
		'ethnolinguistic',
		'estimated_area',
		'year',
    ];
}
