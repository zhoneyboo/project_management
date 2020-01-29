<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\DimensionsOfPoverty;

class CbmsProvinceImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function __construct(int $year)
	{
		$this->year = $year;
	}

    public function collection(Collection $collection)
    {
    	for($i = 9; $i <= 59;$i++ )
    	{
    		DimensionsOfPoverty::create([
    			'indicator' => $collection[$i][0],
				'household_magnitude' => $collection[$i][1],
				'household_proportion' => $collection[$i][2],
				'population_magnitude_total' => $collection[$i][3],
				'population_magnitude_male' => $collection[$i][4],
				'population_magnitude_female' => $collection[$i][5],
				'population_proportion_total' => $collection[$i][6],
				'population_proportion_male' => $collection[$i][7],
				'population_proportion_female' => $collection[$i][8],
				'year' => $this->year,
    		]);
    	}

        return $collection;
    }
}
