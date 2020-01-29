<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Municipality;
use App\Barangay;

class AddressImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
       foreach ($collection as $key => $value) {
       		if ($value[2] == "Mun")
       		{

       		}
       		elseif ($value[2] == "Bgy") {
       			Barangay::create([
       				'barangay' => $value[1],
    					'psgc' => $value[0],
    					'municipality_id' => $value[3],
           		]);
       		}
       }
    }
}
