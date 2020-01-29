<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForestCover extends Model
{
    protected $fillable = [
    	'province',
		'closed_forest',
		'open_forest',
		'mangrove',
		'year',
    ];
}
