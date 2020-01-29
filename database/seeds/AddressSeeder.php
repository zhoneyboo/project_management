<?php

use Illuminate\Database\Seeder;
use App\Municipality;
use App\Barangay;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $municipality = [
                
                [
                    'municipality' => 'Baco',
                    'district' => 1,
                    'psgc' => '175201000',
                ],
                [
                    'municipality' => 'Calapan City',
                    'district' => 1,
                    'psgc' => '175205000',

                ],
                [
                    'municipality' => 'Naujan',
                    'district' => 1,
                    'psgc' => '175208000',

                ],
                [
                    'municipality' => 'Pola',
                    'district' => 1,
                    'psgc' => '175210000',

                ],
                [
                    'municipality' => 'Puerto Galera',
                    'district' => 1,
                    'psgc' => '175211000',

                ],
                [
                    'municipality' => 'San Teodoro',
                    'district' => 1,
                    'psgc' => '175213000',

                ],
                [
                    'municipality' => 'Socorro',
                    'district' => 1,
                    'psgc' => '175214000',

                ],
                [
                    'municipality' => 'Victoria',
                    'district' => 1,
                    'psgc' => '175215000',

                ],
                [
                    'municipality' => 'Bansud',
                    'district' => 2,
                    'psgc' => '175202000',

                ],
                [
                    'municipality' => 'Bongabong',
                    'district' => 2,
                    'psgc' => '175203000',

                ],
                [
                    'municipality' => 'Bulalacao',
                    'district' => 2,
                    'psgc' => '175204000',

                ],
                [
                    'municipality' => 'Gloria',
                    'district' => 2,
                    'psgc' => '175206000',

                ],
                [
                    'municipality' => 'Mansalay',
                    'district' => 2,
                    'psgc' => '175207000',

                ],
                [
                    'municipality' => 'Pinamalayan',
                    'district' => 2,
                    'psgc' => '175209000',

                ],
                [
                    'municipality' => 'Roxas',
                    'district' => 2,
                    'psgc' => '175212000',

                ],
            ];
        Municipality::insert($municipality);

    }
}
