<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ComparativeLaborForce;
use App\ComparativeEmploymentStatus;
use App\PovertyIncidence;
use App\Municipality;
use App\NumberRateBdimd;
use App\DohLicensedHealthFacility;
use App\NutritionalStatus;
use App\HealthFacility;
use App\HealthPersonnel;
use App\SeniorCitizenAndPersonWithDisability;
use App\CrimeStatisticsAndProtectiveFacility;
use App\EducationFacilities;
use App\EnrollmentInGovernmentAndPrivateSchool;
use App\PerformanceIndicatorInPublicSchool;
use App\HealthMorbidity;
use App\HealthInfantMorbidity;
use App\HealthMortality;
use App\HealthInfantMortality;
use App\DimensionsOfPoverty;
use App\FirePrevention;
use App\SocialWelfareService;

class SocialDevelopmentController extends Controller
{
    
    public function getComparativeLaborForce()
    {
        $info = ComparativeLaborForce::get();
        $arr["data"] = [];
        $arr["year"] = [];

        $years = ComparativeLaborForce::groupBy('year')->get();
        $year = [];
        foreach ($years as $value) {
            $year[] = $value->year;
        }

        foreach ($info as  $value) {
            $arr["data"][$value->labor_employment][] = [
                'id' => $value->id,
                'year' => $value->year,
                'rate' => $value->rate,
            ];
        }
        $arr["year"] = $year;
        return $arr;
    }

    public function createComparativeLaborForce(Request $request)
    {
    	$labor_employment = ["Labor Force Participation Rate", "Employment Rate","Unemployment Rate","Underemployment Rate"];
    		foreach ($labor_employment as $value) {
	            $check = ComparativeLaborForce::where([
	                'year' => $request->input('year'),
	                'labor_employment' => $value,
	            ])->first();

	            if(!$check)
	            {
	                $create = ComparativeLaborForce::create([
	                    'labor_employment' => $value,
	                    'rate' => 0,
	                    'year' => $request->input('year'),
	                ]);
	            }
    		}
        return 'true';
    }

    public function updateComparativeLaborForce(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as  $value) {
            foreach ($value as $info) {
                $update = ComparativeLaborForce::where('id', $info["id"])
                                        ->update(['rate' => $info["rate"]]);
            }
        }
        return 'success';
    }

    public function getComparativeEmploymentStatus()
    {
        $info = ComparativeEmploymentStatus::get();
        $arr["data"] = [];
        $arr["year"] = [];

        $years = ComparativeEmploymentStatus::groupBy('year')->get();
        $year = [];
        foreach ($years as $value) {
            $year[] = $value->year;
        }

        foreach ($info as  $value) {
            $arr["data"][$value->labor_employment][] = [
                'id' => $value->id,
                'year' => $value->year,
                'number' => $value->number,
            ];
        }
        $arr["year"] = $year;
        return $arr;
    }

    public function createComparativeEmploymentStatus(Request $request)
    {
        $labor_employment = ["Total in the labor force", "Total Employed","Total Unemployed"];
            foreach ($labor_employment as $value) {
                $check = ComparativeEmploymentStatus::where([
                    'year' => $request->input('year'),
                    'labor_employment' => $value,
                ])->first();

                if(!$check)
                {
                    $create = ComparativeEmploymentStatus::create([
                        'labor_employment' => $value,
                        'number' => 0,
                        'year' => $request->input('year'),
                    ]);
                }
            }
        return 'true';
    }

    public function updateComparativeEmploymentStatus(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as  $value) {
            foreach ($value as $info) {
                $update = ComparativeEmploymentStatus::where('id', $info["id"])
                                        ->update(['number' => $info["number"]]);
            }
        }
        return 'success';
    }

    public function getPovertyIncidence()
    {
        $info = PovertyIncidence::join('municipalities','municipalities.id','=','poverty_incidences.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','poverty_incidences.*','municipalities.district')
                            ->get();
        $arr["data"] = [];
        $arr["year"] = [];

        $years = PovertyIncidence::groupBy('year')->get();
        $year = [];
        foreach ($years as $value) {
            $year[] = $value->year;
        }

        foreach ($info as  $value) {
            $arr["data"][$value->municipality_name][] = [
                'year' => $value->year,
                'id' => $value->id,
                'poverty_incidence' => $value->poverty_incidence,
            ];
        }
        $arr["year"] = $year;
        return $arr;
    }

    public function createPovertyIncidence(Request $request)
    {
        foreach (Municipality::get() as $value) {

            $check = PovertyIncidence::where([
                'year' => $request->input('year'),
                'municipality' => $value->id,
            ])->first();


            if(!$check)
            {
                $create = PovertyIncidence::create([
                    'municipality' => $value->id,
                    'poverty_incidence' => 0,
                    'year' => $request->input('year'),
                ]);
            }
        }
        return 'true';
    }

    public function updatePovertyIncidence(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as  $value) {
            foreach ($value as $info) {
                $update = PovertyIncidence::where('id', $info["id"])
                                        ->update(['poverty_incidence' => $info["poverty_incidence"]]);
            }
        }
        return 'success';
    }


    public function getNumberRateBdimd()
    {
        $info = NumberRateBdimd::get();
        
        $arr["data"] = [];
        $arr["year"] = [];

        $years = NumberRateBdimd::groupBy('year')->get();
        $year = [];
        foreach ($years as $value) {
            $year[] = $value->year;
        }

        foreach ($info as  $value) {
            $arr["data"][$value->indicator][] = [
                'year' => $value->year,
                'id' => $value->id,
                'number' => $value->number,
                'rate' => $value->rate,
            ];
        }
        $arr["year"] = $year;
        return $arr;
    }


    public function createNumberRateBdimd(Request $request)
    {
        $labor_employment = ["Births", "Deaths","Infant Deaths","Maternal Deaths"];
            foreach ($labor_employment as $value) {
                $check = NumberRateBdimd::where([
                    'indicator' => $value,
                    'year' => $request->input('year'),
                ])->first();

                if(!$check)
                {
                    $create = NumberRateBdimd::create([
                        'indicator' => $value,
                        'number' => 0,
                        'rate' => 0,
                        'year' => $request->input('year'),
                    ]);
                }
            }
        return 'true';
    }


    public function updateNumberRateBdimd(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as  $value) {
            foreach ($value as $info) {
                $update = NumberRateBdimd::where('id', $info["id"])
                                        ->update([
                                                'number' => $info["number"],
                                                'rate' => $info["rate"]
                                            ]);
            }
        }
        return 'success';
    }




    public function getDohLicensedHealthFacility()
    {
        return DohLicensedHealthFacility::get();
    }

    public function createDohLicensedHealthFacility(Request $request)
    {
        $create = DohLicensedHealthFacility::create([
            'name_of_facility' => $request->input('name_of_facility'),
            'address' => $request->input('address'),
            'classification' => $request->input('classification'),
        ]);
        return 'success';
    }

    public function updateDohLicensedHealthFacility(Request $request)
    {

         $update = DohLicensedHealthFacility::where('id', $request->input('id'))
                                ->update([
                                    'name_of_facility' => $request->input('name_of_facility'),
                                    'address' => $request->input('address'),
                                    'classification' => $request->input('classification'),
                                ]);
         return 'success';
    }

    public function deleteDohLicensedHealthFacility(Request $request)
    {
        $delete = DohLicensedHealthFacility::where('id', $request->input('id'))->delete();
        return "success";
    }

    public function getNutritionalStatus(Request $request)
    {
        $year = date('o');
        if($request->has('year'))
        {
            $year = $request->input('year');
        }

        return $this->createNutritionalStatus($year);
    }

    public function createNutritionalStatus($year)
    {
        $check = NutritionalStatus::where('year', $year)->get();
        $arr = ["0-5", "6-11","12-23","24-35","36-47","48-59","60-71"];
        if(count($check) <= 0)
        {
            foreach ($arr as $value) {
                $create = NutritionalStatus::create([
                    'age_range' => $value,
                    'normal_boys' => 0,
                    'normal_girls' => 0,
                    'underweight_boys' => 0,
                    'underweight_girls' => 0,
                    'severely_boys' => 0,
                    'severely_girls' => 0,
                    'overweight_boys' => 0,
                    'overweight_girls' => 0,
                    'year' => $year,
                ]);
            }
        }
        
        return NutritionalStatus::where('year', $year)->get();
    }

    public function updateNutritionalStatus(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $value) {
            $update = NutritionalStatus::where('id', $value["id"])
                            ->update([
                                'age_range' => $value["age_range"],
                                'normal_boys' => $value["normal_boys"],
                                'normal_girls' => $value["normal_girls"],
                                'underweight_boys' => $value["underweight_boys"],
                                'underweight_girls' => $value["underweight_girls"],
                                'severely_boys' => $value["severely_boys"],
                                'severely_girls' => $value["severely_girls"],
                                'overweight_boys' => $value["overweight_boys"],
                                'overweight_girls' => $value["overweight_girls"],
                            ]);
        }

        return "success";
    }

    public function getHealthFacility(Request $request)
    {
        $year = date('o');
        if($request->has('year'))
        {
            $year = $request->input('year');
        }

        return $this->createHealthFacility($year);
    }

    public function createHealthFacility($year)
    {
        $check = HealthFacility::where('year', $year)->get();
        $arr = [
                    "Private Hospitals", 
                    "Government Owned Hospitals",
                    "Private Clinics",
                    "Rural Health Units",
                    "City Health Office",
                    "Barangay Health Station ",
                    "Botika ng Lalawigan",
                    "Botika ng Bayan",
                ];
        if(count($check) <= 0)
        {
            foreach ($arr as $value) {
                $create = HealthFacility::create([
                    'facility' => $value,
                    'number' => 0,
                    'year' => $year,
                ]);
            }
        }
        
        return HealthFacility::where('year', $year)->get();
    }

    public function updateHealthFacility(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $value) {
            $update = HealthFacility::where('id', $value["id"])
                            ->update([
                                'number' => $value["number"],
                            ]);
        }

        return "success";
    }

    public function getHealthPersonnel(Request $request)
    {
        $year = date('o');
        if($request->has('year'))
        {
            $year = $request->input('year');
        }

        return $this->createHealthPersonnel($year);
    }

    public function createHealthPersonnel($year)
    {
        $check = HealthPersonnel::where('year', $year)->get();
        $arr = [
                    "Physicians", 
                    "Nurses",
                    "Nutritionist",
                    "Medical Technologist",
                    "Dentists",
                    "Midwives",
                    "Sanitary Inspectors",
                    "Active BHWs",
                ];
        if(count($check) <= 0)
        {
            foreach ($arr as $value) {
                $create = HealthPersonnel::create([
                    'personnel' => $value,
                    'number' => 0,
                    'year' => $year,
                ]);
            }
        }
        
        return HealthPersonnel::where('year', $year)->get();
    }

    public function updateHealthPersonnel(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $value) {
            $update = HealthPersonnel::where('id', $value["id"])
                            ->update([
                                'number' => $value["number"],
                            ]);
        }

        return "success";
    }

    public function getSeniorCitizenAndPersonWithDisability(Request $request)
    {
        $year = date('o');
        if($request->has('year'))
        {
            $year = $request->input('year');
        }

        return $this->createSeniorCitizenAndPersonWithDisability($year);
    }

    public function createSeniorCitizenAndPersonWithDisability($year)
    {
        $check = SeniorCitizenAndPersonWithDisability::where('year', $year)->get();
        
        if(count($check) <= 0)
        {
            foreach (Municipality::get() as $value) {
                $create = SeniorCitizenAndPersonWithDisability::create([
                    'municipality' => $value->id,
                    'senior_male' => 0,
                    'senior_female' => 0,
                    'disability_male' => 0,
                    'disability_female' => 0,
                    'year' => $year,
                ]);
            }
        }
        
        return SeniorCitizenAndPersonWithDisability::where('year', $year)
        ->join('municipalities','municipalities.id','=','senior_citizen_and_person_with_disabilities.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','senior_citizen_and_person_with_disabilities.*','municipalities.district')
                            ->get();
    }

    public function updateSeniorCitizenAndPersonWithDisability(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $value) {
            $update = SeniorCitizenAndPersonWithDisability::where('id', $value["id"])
                            ->update([
                                'senior_male' => $value["senior_male"],
                                'senior_female' => $value["senior_female"],
                                'disability_male' => $value["disability_male"],
                                'disability_female' => $value["disability_female"],
                            ]);
        }

        return "success";
    }


    public function getCrimeStatisticsAndProtectiveFacility(Request $request)
    {
        $year = date('o');
        if($request->has('year'))
        {
            $request->input('year');
        }

        $info = $this->createCrimeStatisticsAndProtectiveFacility($year);
        $arr = [];

        foreach ($info as $key => $value) {
            $arr[$value->group_crime][] = [
                "id" => $value->id,
                "crime" => $value->crime,
                "number" => $value->number,
            ]; 
        }

        return $arr;
    }

    public function createCrimeStatisticsAndProtectiveFacility($year)
    {
        $crime_statistics = [
            "Crime Volume",
            "Crime Solved",
            "Crime Unsolved",
            "Crime Clearance Efficiency (%)",
            "Crime Solution Efficiency (%)",
            "Ave. Monthly Crime Rate (AMCR) (%)"
        ];

        $crime_against_person = [
            "Murder",
            "Homicide",
            "Physical Injuries",
            "Rape"
        ];

        $crime_against_property = [
            "Robbery", "Theft", "Carnapping"
        ];

        $count_crime = CrimeStatisticsAndProtectiveFacility::where('year', $year)->get();

        if(count($count_crime) <= 0)
        {
            foreach ($crime_statistics as $statistic) {
                CrimeStatisticsAndProtectiveFacility::create([
                    'group_crime' => "Crime Statistics",
                    'crime' => $statistic,
                    'number' => 0,
                    'year' => $year,
                ]);
            }

            foreach ($crime_against_person as $person) {
                CrimeStatisticsAndProtectiveFacility::create([
                    'group_crime' => "Crime Against Person",
                    'crime' => $person,
                    'number' => 0,
                    'year' => $year,
                ]);
            }

            foreach ($crime_against_property as $property) {
                CrimeStatisticsAndProtectiveFacility::create([
                    'group_crime' => "Crime Against Property",
                    'crime' => $property,
                    'number' => 0,
                    'year' => $year,
                ]);
            }
        }
        return CrimeStatisticsAndProtectiveFacility::where('year', $year)->get();
    }

    public function updateCrimeStatisticsAndProtectiveFacility(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $crime) {
            foreach ($crime as $value) {
                CrimeStatisticsAndProtectiveFacility::where('id', $value["id"])
                            ->update([
                                'number' => $value["number"]
                            ]);
            }
        }
    }

    public function getEducationFacilities(Request $request)
    {
        $year = date('o');
        if($request->has('year'))
        {
            $year = $request->input('year');
        }

        return EducationFacilities::where('year', $year)->get();
    }

    public function createEducationFacilities(Request $request)
    {
        $create = EducationFacilities::create([
            'facilities' => $request->input('facilities'),
            'province' => 0,
            'calapan' => 0,
            'year' => $request->input('year') ?? date('o'),
        ]);
        return 'success';
    }

    public function deleteEducationFacilities(Request $request)
    {
        $delete = EducationFacilities::where('id', $request->input('id'))->delete();
        return 'success';
    }

    public function updateEducationFacilities(Request $request)
    {
        $data = $request->input('data');
        foreach ($data as $value) {
            $update = EducationFacilities::where('id', $value['id'])->update([
                'province' => $value["province"] ?? 0,
                'calapan' => $value["calapan"] ?? 0,
            ]);
        }
        return 'success';
    }

    public function getEnrollmentInGovernmentAndPrivateSchool(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year') ?? date('o');
        }

        return $this->createEnrollmentInGovernmentAndPrivateSchool($year);
    }

    public function createEnrollmentInGovernmentAndPrivateSchool($year)
    {
        $educational_level = ["Pre-Elementary", "Elementary","Junior High School","Senior High School"];
        $check = EnrollmentInGovernmentAndPrivateSchool::where('year', $year)->get();

        if(count($check) <= 0)
        {
            foreach ($educational_level as $value) {
                $create = EnrollmentInGovernmentAndPrivateSchool::create([
                    'educational_level' => $value,
                    'province_public' => 0,
                    'province_private' => 0,
                    'calapan_public' => 0,
                    'calapan_private' => 0,
                    'calapan_luc_suc' => 0,
                    'year' => $year,
                ]);
            }
        }
        return EnrollmentInGovernmentAndPrivateSchool::where('year', $year)->get();
    }

    public function updateEnrollmentInGovernmentAndPrivateSchool(Request $request)
    {
        $data = $request->input('data');
        foreach ($data as $value) {
            $update = EnrollmentInGovernmentAndPrivateSchool::where('id', $value["id"])
                                ->update([
                                    'province_public' => $value["province_public"],
                                    'province_private' => $value["province_private"],
                                    'calapan_public' => $value["calapan_public"],
                                    'calapan_private' => $value["calapan_private"],
                                    'calapan_luc_suc' => $value["calapan_luc_suc"],
                                ]);
        }
        return 'success';
    }

    public function getPerformanceIndicatorInPublicSchool(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year') ?? date('o');
        }

        return $this->createPerformanceIndicatorInPublicSchool($year);
    }

    public function createPerformanceIndicatorInPublicSchool($year)
    {
        $arr = [
            "Net Enrolment Rate",
            "Cohort Survival Rate",
            "School Leavers Rate",
            "Promotion Rate",
            "Completion Rate"
        ];

        $check = PerformanceIndicatorInPublicSchool::where('year', $year)->get();

        if(count($check) <= 0)
        {
            foreach ($arr as $value) {
                $create = PerformanceIndicatorInPublicSchool::create([
                    'indicator' => $value,
                    'province_elementary' => 0,
                    'province_secondary' => 0,
                    'calapan_elementary' => 0,
                    'calapan_secondary' => 0,
                    'year' => $year,
                ]);
            }
        }
        return PerformanceIndicatorInPublicSchool::where('year', $year)->get();
    }

    public function updatePerformanceIndicatorInPublicSchool(Request $request)
    {
        $data = $request->input('data');
        foreach ($data as $value) {
            $update = PerformanceIndicatorInPublicSchool::where('id', $value["id"])->update([
                    'province_elementary' => $value["province_elementary"],
                    'province_secondary' => $value["province_secondary"],
                    'calapan_elementary' => $value["calapan_elementary"],
                    'calapan_secondary' => $value["calapan_secondary"],
                ]);
        }
        return 'success';
    }


    public function getHealthMorbidity(Request $request)
    {  
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year') ?? date('o');
        }
        return HealthMorbidity::where('year', $year)->get();
    }
    public function createHealthMorbidity(Request $request)
    {
        $create = HealthMorbidity::create([
            'cause' => $request->input('cause'),
            'year_no' => 0,
            'year_rate' => 0,
            'five_year_no' => 0,
            'five_year_rate' => 0,
            'year' => $request->input('year'),
        ]);
    }
    public function updateHealthMorbidity(Request $request)
    {
        $data = $request->input('data');
        foreach ($data as $value) {
             $update = HealthMorbidity::where('id', $value["id"])
                         ->update([
                                'year_no' => $value["year_no"],
                                'year_rate' => $value["year_rate"],
                                'five_year_no' => $value["five_year_no"],
                                'five_year_rate' => $value["five_year_rate"],
                            ]);
        }
        return 'success';
    }
    
    public function deleteHealthMorbidity(Request $request)
    {
        $delete =  HealthMorbidity::where('id', $request->input('id'))->delete();
        return 'success';
    }

    public function getHealthInfantMorbidity(Request $request)
    {  
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year') ?? date('o');
        }
        return HealthInfantMorbidity::where('year', $year)->get();
    }
    public function createHealthInfantMorbidity(Request $request)
    {
        $create = HealthInfantMorbidity::create([
            'cause' => $request->input('cause'),
            'year_no' => 0,
            'year_rate' => 0,
            'five_year_no' => 0,
            'five_year_rate' => 0,
            'year' => $request->input('year'),
        ]);
    }
    public function updateHealthInfantMorbidity(Request $request)
    {
        $data = $request->input('data');
        foreach ($data as $value) {
             $update = HealthInfantMorbidity::where('id', $value["id"])
                         ->update([
                                'year_no' => $value["year_no"],
                                'year_rate' => $value["year_rate"],
                                'five_year_no' => $value["five_year_no"],
                                'five_year_rate' => $value["five_year_rate"],
                            ]);
        }
        return 'success';
    }
    
    public function deleteHealthInfantMorbidity(Request $request)
    {
        $delete =  HealthInfantMorbidity::where('id', $request->input('id'))->delete();
        return 'success';
    }

    public function getHealthMortality(Request $request)
    {  
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year') ?? date('o');
        }
        return HealthMortality::where('year', $year)->get();
    }
    public function createHealthMortality(Request $request)
    {
        $create = HealthMortality::create([
            'cause' => $request->input('cause'),
            'year_no' => 0,
            'year_rate' => 0,
            'five_year_no' => 0,
            'five_year_rate' => 0,
            'year' => $request->input('year'),
        ]);
    }
    public function updateHealthMortality(Request $request)
    {
        $data = $request->input('data');
        foreach ($data as $value) {
             $update = HealthMortality::where('id', $value["id"])
                         ->update([
                                'year_no' => $value["year_no"],
                                'year_rate' => $value["year_rate"],
                                'five_year_no' => $value["five_year_no"],
                                'five_year_rate' => $value["five_year_rate"],
                            ]);
        }
        return 'success';
    }
    
    public function deleteHealthMortality(Request $request)
    {
        $delete =  HealthInfantMorbidity::where('id', $request->input('id'))->delete();
        return 'success';
    }
    public function getHealthInfantMortality(Request $request)
    {  
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year') ?? date('o');
        }
        return HealthInfantMortality::where('year', $year)->get();
    }
    public function createHealthInfantMortality(Request $request)
    {
        $create = HealthInfantMortality::create([
            'cause' => $request->input('cause'),
            'year_no' => 0,
            'year_rate' => 0,
            'five_year_no' => 0,
            'five_year_rate' => 0,
            'year' => $request->input('year'),
        ]);
    }
    public function updateHealthInfantMortality(Request $request)
    {
        $data = $request->input('data');
        foreach ($data as $value) {
             $update = HealthInfantMortality::where('id', $value["id"])
                         ->update([
                                'year_no' => $value["year_no"],
                                'year_rate' => $value["year_rate"],
                                'five_year_no' => $value["five_year_no"],
                                'five_year_rate' => $value["five_year_rate"],
                            ]);
        }
        return 'success';
    }
    
    public function deleteHealthInfantMortality(Request $request)
    {
        $delete =  HealthInfantMortality::where('id', $request->input('id'))->delete();
        return 'success';
    }

    public function getDimensionsOfPoverty(Request $request)
    {
        $year = date('o');
        if($request->has('year'))
        {
            $year = $request->input('year');
        }

       return $this->createDimensionsOfPoverty($year);
    }

    public function updateDimensionsOfPoverty(Request $request)
    {

    }

    public function createDimensionsOfPoverty($year)
    {
        $check = DimensionsOfPoverty::where('year', $year)->get();
        return $check;

    }

    public function getFirePrevention(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return $this->createFirePrevention($year);
    }

    public function createFirePrevention($year)
    {
        $check = FirePrevention::where('year', $year)->get();

        if(count($check) <= 0)
        {
            $municipality = [
                'Office of the Provincial Fire Marshal',
                'Baco',
                'Bansud',
                'Bongabong',
                'Bulalacao',
                'Calapan City',
                'Gloria',
                'Mansalay',
                'Naujan',
                'Pinamalayan',
                'Pola',
                'Puerta Galera',
                'Roxas',
                'San Teodoro',
                'Socorro',
                'Victoria',
            ];

            foreach ($municipality as $value) {
                FirePrevention::create([
                    'municipality' => $value,
                    'year' => $year,
                ]);
            }
        }

        
        return FirePrevention::where('year', $year)->get();
    }

    public function updateFirePrevention(Request $request)
    {
        $data = $request->input('data');
        foreach ($data as $value) {
            $update = FirePrevention::where('id', $value["id"])
                        ->update([
                            'no_of_fire_station_bfp' => $value["no_of_fire_station_bfp"],
                            'no_of_fire_station_lgu' => $value["no_of_fire_station_lgu"],
                            'no_of_fire_trucks_bfp' => $value["no_of_fire_trucks_bfp"],
                            'no_of_fire_trucks_lgu' => $value["no_of_fire_trucks_lgu"],
                            'no_of_fire_trucks_ngo' => $value["no_of_fire_trucks_ngo"],
                            'no_of_personnel' => $value["no_of_personnel"],
                        ]);
        }
        return 'success';
    }

    public function getSocialWelfareService(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return $this->createSocialWelfareService($year);
    }

    public function createSocialWelfareService($year)
    {
        $check = SocialWelfareService::where('year', $year)->get();

        if(count($check) <= 0)
        {
            $municipality = [
                'Baco',
                'Bansud',
                'Bongabong',
                'Bulalacao',
                'Calapan City',
                'Gloria',
                'Mansalay',
                'Naujan',
                'Pinamalayan',
                'Pola',
                'Puerta Galera',
                'Roxas',
                'San Teodoro',
                'Socorro',
                'Victoria',
                'PGOrM-PSWDO',
                'DSWD',
            ];

            foreach ($municipality as $value) {
                SocialWelfareService::create([
                    'municipality' => $value,
                    'year' => $year,
                ]);
            }
        }
        return SocialWelfareService::where('year', $year)->get();
    }

    public function updateSocialWelfareService(Request $request)
    {
        $data = $request->input('data');
        foreach ($data as $value) {
            $update = SocialWelfareService::where('id', $value["id"])
                        ->update([
                            'social_worker_male' => $value["social_worker_male"],
                            'social_worker_female' => $value["social_worker_female"],
                            'day_care_male' => $value["day_care_male"],
                            'day_care_female' => $value["day_care_female"],
                            'no_of_day_care_centers' => $value["no_of_day_care_centers"],
                            'children_served_male' => $value["children_served_male"],
                            'children_served_female' => $value["children_served_female"],
                        ]);
        }
        return 'success';
    }



    

}
