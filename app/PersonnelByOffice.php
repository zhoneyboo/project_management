<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonnelByOffice extends Model
{
    protected $fillable = [
    	'name_of_office',
		'no_plantilla_position',
		'no_of_filled_up_position',
		'group',
    ];


    public static function getDefault($year)
    {
    	$personnelbyoffice = [
            [
                'name_of_office' => "Office of the Governor",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 1,
                'year' => $year,
            ],
            [
                'name_of_office' => "Management Support Staff Division",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 1,
                'year' => $year,
            ],
            [
                'name_of_office' => "Internal Audit Service Division",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 1,
                'year' => $year,
            ],
            [
                'name_of_office' => "Special Concerns Division",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 1,
                'year' => $year,
            ],
            [
                'name_of_office' => "Disaster Risk Reduction and Management Division",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 1,
                'year' => $year,
            ],
            [
                'name_of_office' => "Communication and Public Relations Division",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 1,
                'year' => $year,
            ],
            [
                'name_of_office' => "Education and Employment Services Division",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 1,
                'year' => $year,
            ],
            [
                'name_of_office' => "Office of the Vice-Governor and Sangguniang Panlalawigan ",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 2,
                'year' => $year,
            ],
            [
                'name_of_office' => "Provincial Administrator’s Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 3,
                'year' => $year,
            ],
            [
                'name_of_office' => "Provincial Planning and Development Office ",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 4,
                'year' => $year,
            ],
            [
                'name_of_office' => "Provincial Treasurer’s Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 5,
                'year' => $year,
            ],
            [
                'name_of_office' => "Provincial Accounting Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 6,
                'year' => $year,
            ],
            [
                'name_of_office' => "Provincial Budget Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 7,
                'year' => $year,
            ],
            [
                'name_of_office' => "Provincial Assessor’s Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 8,
                'year' => $year,
            ],
            [
                'name_of_office' => "Provincial Human Resource Management Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 9,
                'year' => $year,
            ],
            [
                'name_of_office' => "Provincial General Services Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 10,
                'year' => $year,
            ],
            [
                'name_of_office' => "Provincial Legal Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 11,
                'year' => $year,
            ],
            [
                'name_of_office' => "Provincial Social Welfare and Development Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 12,
                'year' => $year,
            ],
            [
                'name_of_office' => "Provincial Health Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 13,
                'year' => $year,
            ],
            [
                'name_of_office' => "Oriental Mindoro Provincial Hospital",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 13,
                'year' => $year,
            ],
            [
                'name_of_office' => "Oriental Mindoro Central District Hospital",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 13,
                'year' => $year,
            ],
            [
                'name_of_office' => "Naujan Community Hospital",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 13,
                'year' => $year,
            ],
            [
                'name_of_office' => "Bulalacao Community Hospital",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 13,
                'year' => $year,
            ],
            [
                'name_of_office' => "Oriental Mindoro Southern District Hospital",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 13,
                'year' => $year,
            ],
            [
                'name_of_office' => "Provincial Engineering Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 14,
                'year' => $year,
            ],

            [
                'name_of_office' => "Provincial Agriculture Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 15,
                'year' => $year,
            ],

            [
                'name_of_office' => "Provincial Veterinary Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 16,
                'year' => $year,
            ],
            [
                'name_of_office' => "Environment and Natural Resource Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 17,
                'year' => $year,
            ],
            [
                'name_of_office' => "Provincial Tourism, Investments and Enterprise Development Office ",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 18,
                'year' => $year,
            ],
            [
                'name_of_office' => "Botika ng Lalawigan ng Oriental Mindoro ",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 19,
                'year' => $year,
            ],
        ];

        return $personnelbyoffice;
    }
}
