<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollmentInGovernmentAndPrivateSchool extends Model
{
    protected $fillable = [
    	'educational_level',
		'province_public',
		'province_private',
		'calapan_public',
		'calapan_private',
		'calapan_luc_suc',
		'year',
    ];
}
