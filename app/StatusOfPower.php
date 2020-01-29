<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusOfPower extends Model
{
    protected $fillable = [
    	'municipality',
		'barangay_covered',
		'barangay_energized',
		'sitios_energized',
		'sitios_unerginized',
		'house_connections',
		'members_approved',
		'year',
    ];
}
