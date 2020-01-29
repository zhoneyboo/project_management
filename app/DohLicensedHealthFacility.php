<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DohLicensedHealthFacility extends Model
{
    protected $fillable = [
    	'name_of_facility',
		'address',
		'classification',
    ];
}
