<?php
 
use Illuminate\Database\Seeder;
use App\User;
use App\GeneralInformation;
use App\Municipality;

use App\PersonnelByOffice;
use App\ImplementorAgencyList;
use App\MonitoredByList;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $monitored_list = [
            ["monitor" => "Patria L. Cadacio, PEO IV"],
            ["monitor" => "Edmin L. Distajo, PEO III"],
            ["monitor" => "Nestor M. Monongsong, PEO II"],
            ["monitor" =>  "Jeffrey G. Maramot, PEO I"],
            ["monitor" => "Provincial Project Monitoring Team"],
        ];
        $implementor = [
            [ "implementor" => "Local Government Unit"],
            [ "implementor" => "Others"],
            [ "implementor" => "Provincial Engineering Office"],
            [ "implementor" => "Provincial Social Welfare and Development Office"],
            [ "implementor" => "Provincial Veterinary Office"],
            [ "implementor" => "Provincial Health Office"],
            [ "implementor" => "Provincial Agriculture Office"],
            [ "implementor" => "GO-Education, Employment Services Division"],
            [ "implementor" => "GO-SICAD"],
            [ "implementor" => "PG-Environment and Natural Resources Office"],
            [ "implementor" => "Provincial Tourism Investments and Enterprise Development Office"],
            [ "implementor" => "DPWH-Southern Mindoro District Engineering Office"],
            [ "implementor" => "DPWH-Mindoro Oriental District Engineering Office"],
            [ "implementor" => "Department of the Interior and Local Government"],
        ];


        GeneralInformation::create([
            'location' => 'Oriental Mindoro is located in MIMAROPA Region. It lies 45 kilometers south of Batangas and 130 kilometers south of Manila.',
            'topography' => 'Oriental Mindoro has a rugged terrain and an irregular coastline. Numerous rivers and streams traverse the province but none are navigable by large vessels.',
            'land_area' => 'Oriental Mindoro has a total land area of 4,364.72 square kilometers or 436,472 hectares. It represents 1.5 percent of the total land area of the country and 16 percent of the MIMAROPA Region',
            'boundary' => 'It is bounded by Verde Island Passage of the North; Maestro del Campo Island and Tablas Strait on the East; Semirara Island on the South; and Occidental Mindoro on the West.',
            'climate' => 'The province has two climate types: Type I and Type III. Type I is characterized by two pronounced seasons, dry and wet. Type III has no pronounced season, relatively dry from November to April and wet during the rest of the year.',
            'capital' => 'Calapan City',
            'date_of_approval' => '1950-11-15',
            'legal_basis' => 'RA 505 (Division of Mindoro)',
            'no_of_component_city' => '1',
            'no_of_municipality' => '14',
            'no_of_congressional_district' => '2',
            'no_of_barangay' => '426',
        ]);


    	
        $user = [
        	'email' => 'mark@gmail.com',
        	'name' => 'Mark Alfred',
        	'password' => bcrypt('072915'),
            'role' => 1,
        ];


       
            
        $personnelbyoffice = [
            [
                'name_of_office' => "Office of the Governor",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 1,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Management Support Staff Division",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 1,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Internal Audit Service Division",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 1,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Special Concerns Division",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 1,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Disaster Risk Reduction and Management Division",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 1,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Communication and Public Relations Division",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 1,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Education and Employment Services Division",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 1,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Office of the Vice-Governor and Sangguniang Panlalawigan ",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 2,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Provincial Administrator’s Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 3,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Provincial Planning and Development Office ",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 4,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Provincial Treasurer’s Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 5,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Provincial Accounting Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 6,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Provincial Budget Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 7,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Provincial Assessor’s Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 8,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Provincial Human Resource Management Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 9,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Provincial General Services Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 10,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Provincial Legal Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 11,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Provincial Social Welfare and Development Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 12,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Provincial Health Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 13,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Oriental Mindoro Provincial Hospital",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 13,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Oriental Mindoro Central District Hospital",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 13,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Naujan Community Hospital",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 13,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Bulalacao Community Hospital",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 13,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Oriental Mindoro Southern District Hospital",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 13,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Provincial Engineering Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 14,
                'year' => date('o'),
            ],

            [
                'name_of_office' => "Provincial Agriculture Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 15,
                'year' => date('o'),
            ],

            [
                'name_of_office' => "Provincial Veterinary Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 16,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Environment and Natural Resource Office",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 17,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Provincial Tourism, Investments and Enterprise Development Office ",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 18,
                'year' => date('o'),
            ],
            [
                'name_of_office' => "Botika ng Lalawigan ng Oriental Mindoro ",
                'no_plantilla_position' => 0,
                'no_of_filled_up_position' => 0,
                'group' => 19,
                'year' => date('o'),
            ],
        ];

        PersonnelByOffice::insert($personnelbyoffice);
        ImplementorAgencyList::insert($implementor);
        User::insert($user);
        
        MonitoredByList::insert($monitored_list);


    }
}
