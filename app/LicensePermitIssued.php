<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicensePermitIssued extends Model
{
    protected $fillable = [
    	'pro_new_first_sem',
		'pro_new_second_sem',
		'pro_renew_first_sem',
		'pro_renew_second_sem',
		'non_pro_new_first_sem',
		'non_pro_new_second_sem',
		'non_pro_renew_first_sem',
		'non_pro_renew_second_sem',
		'student_first_sem',
		'student_second_sem',
		'year'
    ];
}
