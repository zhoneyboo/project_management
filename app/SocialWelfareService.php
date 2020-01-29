<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialWelfareService extends Model
{
    protected $fillable = [
    	'municipality',
		'social_worker_male',
		'social_worker_female',
		'day_care_male',
		'day_care_female',
		'no_of_day_care_centers',
		'children_served_male',
		'children_served_female',
		'year',
    ];
}
