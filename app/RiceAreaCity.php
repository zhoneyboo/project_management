<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiceAreaCity extends Model
{
    protected $fillable = [
    	"municipality",
		"irrigated_area",
		"rainfed_area",
		"total_rice_area",
		"year",
    ];
}
