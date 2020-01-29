<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopFiveProduct extends Model
{
    protected $fillable = [
    	"municipality",
		"product",
		"quantity",
		"year",
    ];
}
