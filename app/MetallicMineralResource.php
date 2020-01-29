<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetallicMineralResource extends Model
{
    protected $fillable = [
    	'mineral',
		'municipality',
		'year',
    ];
}
