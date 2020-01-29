<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnergizedUnergizedBarangay extends Model
{
    protected $fillable = [
    	'municipality',
		'potential',
		'energized',
		'year',
    ];
}
