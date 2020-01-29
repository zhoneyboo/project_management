<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonnelByOffice;
use App\PersonnelByStatus;
use App\WaterSystem;

class InstitutionalProfileController extends Controller
{
    public function getPersonnelByOffice(Request $request)
    {
    	
    	if($request->has('year'))
    	{
    		return $this->organizeArr($this->createPersonnelByOffice($request->input('year')));
    	}else{
    		return $this->organizeArr($this->createPersonnelByOffice(date('o')));
     	}

    }

    public function createPersonnelByOffice($year)
    {
    	$arr = PersonnelByOffice::where('year', $year)->get();

    	if(count($arr) <= 0)
    	{
    		PersonnelByOffice::insert(PersonnelByOffice::getDefault($year));
    	}
    	return PersonnelByOffice::where('year' ,$year)->get();
    }


    public function organizeArr($arr)
    {
    	$array = [];
    	foreach ($arr as $value) {
    		$array[$value->group][] = [
    			'id' => $value->id,
				'name_of_office' => $value->name_of_office,
				'no_plantilla_position' => $value->no_plantilla_position,
				'no_of_filled_up_position' => $value->no_of_filled_up_position,
				'group' => $value->group,
				'year' => $value->year,
    		];
    	}

    	return $array;
    }

    public function updatePersonnelByOffice(Request $request)
    {
    	$arr = $request->input('data');
    	foreach ($arr as $value) {
    		foreach ($value as $final_data) {
    			PersonnelByOffice::where('id', $final_data['id'])->update([
					'name_of_office' => $final_data['name_of_office'],
					'no_plantilla_position' => $final_data['no_plantilla_position'],
					'no_of_filled_up_position' => $final_data['no_of_filled_up_position'],
					'group' => $final_data['group'],
					'year' => $final_data['year'],
    			]);
    		}
    	}

    	return 'success';
    }

    public function getPersonnelByStatus(Request $request)
    {
        if($request->has('year'))
        {
            return $this->createPersonnelByStatus($request->input('year'));
        }else{
            return $this->createPersonnelByStatus(date('o'));
        }
    }

    public function createPersonnelByStatus($year)
    {
        $check = PersonnelByStatus::where('year', $year)->first();

        if(!isset($check))
        {
            $check = PersonnelByStatus::create([
                'permanent_first_male' => 0,
                'permanent_first_female' => 0,
                'permanent_second_male' => 0,
                'permanent_second_female' => 0,
                'co_terminous_first_male' => 0,
                'co_terminous_first_female' => 0,
                'co_terminous_second_male' => 0,
                'co_terminous_second_female' => 0,
                'elective_male' => 0,
                'elective_female' => 0,
                'year' => $year,
            ]);
        }
        return $check;
    }

    public function updatePersonnelByStatus(Request $request)
    {
        $update = PersonnelByStatus::where('id',$request->input('id'))
                                    ->update([
                                        'permanent_first_male' => $request->input('permanent_first_male'),
                                        'permanent_first_female' => $request->input('permanent_first_female'),
                                        'permanent_second_male' => $request->input('permanent_second_male'),
                                        'permanent_second_female' => $request->input('permanent_second_female'),
                                        'co_terminous_first_male' => $request->input('co_terminous_first_male'),
                                        'co_terminous_first_female' => $request->input('co_terminous_first_female'),
                                        'co_terminous_second_male' => $request->input('co_terminous_second_male'),
                                        'co_terminous_second_female' => $request->input('co_terminous_second_female'),
                                        'elective_male' => $request->input('elective_male'),
                                        'elective_female' => $request->input('elective_female'),
                                    ]);
    }

   
}
