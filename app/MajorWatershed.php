<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MajorWatershed extends Model
{
    protected $fillable = [
    	'name',
		'location',
		'classification',
		'area',
		'year'
    ];
}
