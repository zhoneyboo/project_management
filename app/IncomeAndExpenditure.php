<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeAndExpenditure extends Model
{
    protected $fillable = [
    	'income_general_fund',
		'expenditures_obligations',
		'tax_revenue',
		'permit_and_license',
		'service_income',
		'business_income',
		'other_income',
		'grants_and_donation',
		'personal_services',
		'mooe',
		'capitals_outlays',
		'year',
    ];
}
