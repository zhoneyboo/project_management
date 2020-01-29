<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\CbmsProvinceImport;

class CbmsImport implements ToCollection, WithMultipleSheets 
{


	public function __construct(string $year)
	{
		$this->year = $year;
	}

	 public function collection(Collection $collection)
    {
        return $collection;

    }

    public function sheets(): array
    {
        return [
            'province' => new CbmsProvinceImport((int) $this->year),
        ];
    }
}
