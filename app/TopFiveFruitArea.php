<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopFiveFruitArea extends Model
{
     protected $fillable = [
    	"municipality",
		"product",
		"quantity",
		"year",
    ];
}
