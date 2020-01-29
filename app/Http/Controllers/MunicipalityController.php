<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Municipality;
use App\Barangay;

class MunicipalityController extends Controller
{


	public function watershed()
	{
		return Municipality::with_watershed();
	}

	public function get(){
		return Municipality::get();
	}

	public function getMunicipalityWithPSGC()
	{
		return Municipality::orderBy('municipality', 'ASC')->get();
	}

	public function getBarangay(Request $request)
	{
		return Barangay::where('municipality_id', $request->input('id'))->get();
	}

	public function getBarangayWithPSGC()
	{
		return Barangay::get();
	}
}
