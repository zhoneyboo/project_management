<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnualIncomeBudget extends Model
{
    protected $fillable = [
    	'municipality',
		'income',
		'budget',
		'year',
    ];
}
