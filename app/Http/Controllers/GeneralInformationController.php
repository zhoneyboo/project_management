<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneralInformation;


class GeneralInformationController extends Controller
{


	public function get(){
		return GeneralInformation::get();
	}    

	public function getYear(Request $request)
	{
		return GeneralInformation::first();
	}

	public function insert(Request $request){
		// // $this->validator($request);

		// $testInfo = GeneralInformation::where('year', $request->input('year'))
		// 								->first();
		// if($testInfo)
		// {
		// 	$this->update($request);
		// }else{
		// 	$create = GeneralInformation::create([
		// 		'location' => $request->input('location'),
		// 		'topography' => $request->input('topography'),
		// 		'land_area' => $request->input('land_area'),
		// 		'boundary' => $request->input('boundary'),
		// 		'climate' => $request->input('climate'),
		// 		'capital' => $request->input('capital'),
		// 		'date_of_approval' => $request->input('date_of_approval'),
		// 		'legal_basis' => $request->input('legal_basis'),
		// 		'no_of_component_city' => $request->input('no_of_component_city') ?? 0,
		// 		'no_of_municipality' => $request->input('no_of_municipality') ?? 0,
		// 		'no_of_congressional_district' => $request->input('no_of_congressional_district') ?? 0,
		// 		'no_of_barangay' => $request->input('no_of_barangay') ?? 0,
		// 		'year' => $request->input('year'),
		// 	]);
		// }

	}

	public function update(Request $request){
		// $this->validator($request);
		$update = GeneralInformation::where('id', $request->input('id'))
			->update([
			'location' => $request->input('location'),
			'topography' => $request->input('topography'),
			'land_area' => $request->input('land_area'),
			'boundary' => $request->input('boundary'),
			'climate' => $request->input('climate'),
			'capital' => $request->input('capital'),
			'date_of_approval' => $request->input('date_of_approval'),
			'legal_basis' => $request->input('legal_basis'),
			'no_of_component_city' => $request->input('no_of_component_city'),
			'no_of_municipality' => $request->input('no_of_municipality'),
			'no_of_congressional_district' => $request->input('no_of_congressional_district'),
			'no_of_barangay' => $request->input('no_of_barangay'),
		]);


	}
	public function validator($arr)
	{
		$arr->validate([
			'location' => 'required',
			'topography' => 'required',
			'land_area' => 'required',
			'boundary' => 'required',
			'climate' => 'required',
			'capital' => 'required',
			'date_of_approval' => 'required',
			'legal_basis' => 'required',
			'no_of_component_city' => 'required',
			'no_of_municipality' => 'required',
			'no_of_congressional_district' => 'required',
			'no_of_barangay' => 'required',
			'year' => 'required',
		]);
	}


	public function remove(Request $request){
		$request->validate([
			'year' => 'required',
		]);
		$delete = GeneralInformation::where('year', $request->input('year'))
									->delete();

	}

}
