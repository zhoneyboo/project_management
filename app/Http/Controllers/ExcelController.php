<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

use App\Imports\CbmsImport;
use App\Imports\AddressImport;
use App\Http\Controllers\FileController;
use Storage;

class ExcelController extends Controller
{

 	public function uploadCBMS(Request $request)
 	{
 		// $explode = explode(',', $request->input('cbms'));
        // $file = base64_decode($request->input('cbms'));
 		$file = FileController::uf_base64($request->input('cbms'), '/cbms');
    	$excel = Excel::import(new CbmsImport($request->input('year')), $file, 'public',\Maatwebsite\Excel\Excel::XLSX);
 	}

 	public function addBarangay(Request $request)
 	{
 		$excel = Excel::import(new AddressImport(), '/city_mun.xlsx', 'public',\Maatwebsite\Excel\Excel::XLSX);

 		return 'success';
 	}



 


}
