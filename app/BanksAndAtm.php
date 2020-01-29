<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BanksAndAtm extends Model
{
    protected $fillable = [
    	'municipality',
		'banks',
		'atm',
		'year'
    ];
}
