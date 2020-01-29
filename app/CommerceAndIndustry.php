<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommerceAndIndustry extends Model
{
    protected $fillable = [
    	'sectoral_classification',
		'no_of_applications',
		'investments',
		'employment',
		'year',
    ];
}
