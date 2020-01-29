<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnnualIncomeBudget;
use App\Municipality;
use App\IncomeAndExpenditure;



class FinancialProfileController extends Controller
{
    public function getAnnualIncomeBudget(Request $request)
    {
    	if($request->has('year'))
    	{
    		return $this->createAnnualIncomeBudget($request->input('year'));
    	}else{
    		return $this->createAnnualIncomeBudget(date('o'));
    	}
    }

    public function createAnnualIncomeBudget($year)
    {
    	$annualincomebudget = AnnualIncomeBudget::where('year', $year)->get();

    	if(count($annualincomebudget) <= 0)
    	{
    		foreach (Municipality::get() as $value) {
    			AnnualIncomeBudget::create([
    				'municipality' => $value->id,
					'income' => 0,
					'budget' => 0,
					'year' => $year,
    			]);
    		}
    	}
    	return AnnualIncomeBudget::where('year', $year)
                                    ->join('municipalities','municipalities.id','=','annual_income_budgets.municipality')
                                    ->get();
    }


    public function updateAnnualIncomeBudget(Request $request)
    {
    	$arr = $request->input('data');
    	foreach ($arr as $value) {
    		AnnualIncomeBudget::where('id', $value['id'])->update([
					'income' => $value["income"],
					'budget' => $value["budget"],
					'year' => $value["year"],
    			]);
    	}
    	return 'success';
    }


    public function getIncomeAndExpenditure(Request $request)
    {
        if($request->has('year'))
        {
            return $this->createIncomeAndExpenditure($request->input('year'));
        }else{
            return $this->createIncomeAndExpenditure(date('o'));
        }
    }

    public function createIncomeAndExpenditure($year)
    {
        $check = IncomeAndExpenditure::where('year', $year)->first();

        if(!isset($check))
        {
            $check = IncomeAndExpenditure::create([
                'income_general_fund' => 0,
                'expenditures_obligations' => 0,
                'tax_revenue' => 0,
                'permit_and_license' => 0,
                'service_income' => 0,
                'business_income' => 0,
                'other_income' => 0,
                'grants_and_donation' => 0,
                'personal_services' => 0,
                'mooe' => 0,
                'capitals_outlays' => 0,
                'year' => $year,
            ]);
        }

        return $check;
    }

    public function updateIncomeAndExpenditure(Request $request)
    {

        $check = IncomeAndExpenditure::where('id', $request->input('id'))
                                       ->update([
                                            'income_general_fund' => $request->input('income_general_fund'),
                                            'expenditures_obligations' => $request->input('expenditures_obligations'),
                                            'tax_revenue' => $request->input('tax_revenue'),
                                            'permit_and_license' => $request->input('permit_and_license'),
                                            'service_income' => $request->input('service_income'),
                                            'business_income' => $request->input('business_income'),
                                            'other_income' => $request->input('other_income'),
                                            'grants_and_donation' => $request->input('grants_and_donation'),
                                            'personal_services' => $request->input('personal_services'),
                                            'mooe' => $request->input('mooe'),
                                            'capitals_outlays' => $request->input('capitals_outlays'),
                                        ]);
        return 'success';
    }

}
