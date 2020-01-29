<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AncestralDomain;
use App\PopulationByCensusYear;
use App\Municipality;
use App\HouseholdPopulationBySex;
use App\MangyanTribe;
use App\ActualProjected;
use App\ActualProjectedInfo;
use App\PopulationDensity;
use App\PopulationDensityInfo;
use App\ProjectedPopulationInfo;
use App\ProjectedPopulation;
use App\UrbanRuralPopulation;
use App\UrbanRuralPopulationInfo;

class DemographController extends Controller
{
    public function getYearUrbanRuralPopulation()
    {
        return UrbanRuralPopulationInfo::get();
    }
    public function getUrbanRuralPopulation(Request $request){
        // urban_rural_populations
        // urban_rural_population_infos
        $urban_rural_population_infos = UrbanRuralPopulationInfo::where('year_of_encoding', $request->input('actual_year'))->first();

        if($urban_rural_population_infos)
        {
            $urban_rural_populations = UrbanRuralPopulation::where('urban_rural_population_infos_id', $urban_rural_population_infos->id)
                            ->join('municipalities','municipalities.id','=','urban_rural_populations.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','urban_rural_populations.*','municipalities.district')
                            ->get();
        }else{
            $urban_rural_populations = [];
            $urban_rural_population_infos = [];
        }
        return [
            'urban_rural_populations' => $urban_rural_populations,
            'urban_rural_population_infos' => $urban_rural_population_infos,
        ];
    }
    public function createUrbanRuralPopulation(Request $request){

        $create = UrbanRuralPopulationInfo::create([
            'population_year_1' => $request->input('population_year_1'),
            'population_year_2' => $request->input('population_year_2'),
            'year_of_encoding' => $request->input('year_of_encoding'),
        ]);

        foreach (Municipality::get() as $value) {
            $info = UrbanRuralPopulation::create([
                'urban_rural_population_infos_id' => $create->id,
                'municipality' => $value->id,
                'no_of_barangays_urban' => 0,
                'no_of_barangays_rural' => 0,
                'population_urban_year_1' => 0,
                'population_rural_year_1' => 0,
                'population_urban_year_2' => 0,
                'population_rural_year_2' => 0,
            ]);
        }

        return 'success';
    }
    public function updateUrbanRuralPopulation(Request $request){
        $data = $request->input('data');
        foreach ($data as $value) {
            $update = UrbanRuralPopulation::where('id', $value["id"])
                            ->update([
                                'no_of_barangays_urban' => $value["no_of_barangays_urban"],
                                'no_of_barangays_rural' => $value["no_of_barangays_rural"],
                                'population_urban_year_1' => $value["population_urban_year_1"],
                                'population_rural_year_1' => $value["population_rural_year_1"],
                                'population_urban_year_2' => $value["population_urban_year_2"],
                                'population_rural_year_2' => $value["population_rural_year_2"],
                            ]);
        }
        return 'success';
    }

    public function getProjectedPopulation(Request $request)
    {
        $projected_population_infos = ProjectedPopulationInfo::where('year_of_encoding', $request->input('actual_year'))->first();

        if($projected_population_infos)
        {
            $projected_populations = ProjectedPopulation::where('projected_population_infos_id', $projected_population_infos->id)->get();
        }
        else
        {
            $projected_population_infos = [];
            $projected_populations = [];          
        }

        return [
            'projected_population_infos' => $projected_population_infos,
            'projected_populations' => $projected_populations,    
        ];
    }

    public function createProjectedPopulation(Request $request)
    {
        $create = ProjectedPopulationInfo::create([
            'actual_year_1' => $request->input('actual_year_1'),
            'actual_year_2' => $request->input('actual_year_2'),
            'growth_rate' => $request->input('growth_rate'),
            'projection_year_1' => $request->input('projection_year_1'),
            'projection_year_2' => $request->input('projection_year_2'),
            'projection_year_3' => $request->input('projection_year_3'),
            'year_of_encoding' => $request->input('year_of_encoding'),
        ]);
        $arr = ["Occidental Mindoro", "Oriental Mindoro", "Marinduque", "Romblon","Palawan","Puerto Princesa City"];
        if($create)
        {
            foreach ($arr as $value) {
                $details = ProjectedPopulation::create([
                    'projected_population_infos_id' => $create->id,
                    'province' => $value,
                    'actual_year_1' => 0,
                    'actual_year_2' => 0,
                    'growth_rate' => 0,
                    'projection_year_1' => 0,
                    'projection_year_2' => 0,
                    'projection_year_3' => 0,
                ]);
            }
        }
        return 'success';
    }

    public function updateProjectedPopulation(Request $request)
    {
        $data =  $request->input('data');
        foreach ($data as $value) {
           $update = ProjectedPopulation::where('id', $value["id"])->update([
                    'actual_year_1' => $value["actual_year_1"],
                    'actual_year_2' => $value["actual_year_2"],
                    'growth_rate' => $value["growth_rate"],
                    'projection_year_1' => $value["projection_year_1"],
                    'projection_year_2' => $value["projection_year_2"],
                    'projection_year_3' => $value["projection_year_3"],
                ]);
        }
        return 'success';
    }
    public function getYearPopulationDensity(Request $request)
    {
        return PopulationDensityInfo::get();
    }

    public function getPopulationDensity(Request $request)
    {

        $population_density_infos = PopulationDensityInfo::where('actual_year', $request->input('actual_year'))->first();

        if($population_density_infos)
        {
            $population_densities = PopulationDensity::where('population_density_infos_id', $population_density_infos->id)
                            ->join('municipalities','municipalities.id','=','population_densities.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','population_densities.*','municipalities.district')
                            ->get();
        }else{
            $population_densities = [];
            $population_density_infos = [];
        }

        return [
            'population_densities' => $population_densities,
            'population_density_infos' => $population_density_infos,
        ];
    }

    public function createPopulationDensity(Request $request)
    {
        $create = PopulationDensityInfo::create([
            'old_year' => $request->input('old_year'),
            'actual_year' => $request->input('actual_year'),
            'estimated' => $request->input('estimated'),
        ]);

        foreach (Municipality::get() as $value) {
            $info = PopulationDensity::create([
                'population_density_infos_id' => $create->id,
                'municipality' => $value->id,
                'gross_old' => 0,
                'gross_actual' => 0,
                'urban_old' => 0,
                'urban_actual' => 0,
                'estimated_gross' => 0,
            ]);
        }

        return 'success';
    }

    public function updatePopulationDensity(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $value) {
            $update = PopulationDensity::where('id', $value["id"])
                        ->update([
                            'gross_old' => $value["gross_old"],
                            'gross_actual' => $value["gross_actual"],
                            'urban_old' => $value["urban_old"],
                            'urban_actual' => $value["urban_actual"],
                            'estimated_gross' => $value["estimated_gross"],
                        ]);
        }

        return 'success';
    }

    public function getActualProjected(Request $request)
    {
        $actual_projected_infos = ActualProjectedInfo::where('actual_year', $request->input('actual_year'))->first();

        if($actual_projected_infos)
        {
            $actual_projected = ActualProjected::where('actual_projected_infos_id', $actual_projected_infos->id)
                            ->join('municipalities','municipalities.id','=','actual_projecteds.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','actual_projecteds.*','municipalities.district')
                            ->get();
        }else{
            $actual_projected = [];
            $actual_projected_infos = [];
        }

        return [
            'actual_projected_infos' => $actual_projected_infos,
            'actual_projected' => $actual_projected,
        ];
    }

    public function createActualProjected(Request $request)
    {
        $create_info = ActualProjectedInfo::create([
            'old_year'  => $request->input('old_year'),
            'actual_year'  => $request->input('actual_year'),
            'projected_year'  => $request->input('projected_year'),
            'growth_rate_1'  => $request->input('growth_rate_1'),
            'growth_rate_2'  => $request->input('growth_rate_2'),
        ]);

        foreach (Municipality::get() as $value) {
            $create = ActualProjected::create([
                'actual_projected_infos_id' => $create_info->id,
                'municipality' => $value->id,
                'old_year_pop' => 0,
                'old_year_hh' => 0,
                'actual_year_pop' => 0,
                'actual_year_hh' => 0,
                'projected_year_pop' => 0,
                'projected_year_hh' => 0,
                'growth_rate_1' => 0,
                'growth_rate_2' => 0,
            ]);
        }

        return 'success';
    }

    public function getYearActualProjected(Request $request)
    {
        $actual_year = ActualProjectedInfo::get();
        return $actual_year;
    }

    public function updateActualProjected(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $value) {
           $update = ActualProjected::where('id', $value["id"])
                            ->update([
                                'old_year_pop' => $value["old_year_pop"],
                                'old_year_hh' => $value["old_year_hh"],
                                'actual_year_pop' => $value["actual_year_pop"],
                                'actual_year_hh' => $value["actual_year_hh"],
                                'projected_year_pop' => $value["projected_year_pop"],
                                'projected_year_hh' => $value["projected_year_hh"],
                                'growth_rate_1' => $value["growth_rate_1"],
                                'growth_rate_2' => $value["growth_rate_2"],
                            ]);
        }

        return 'success';
    }



    public function getAncestralDomain(Request $request){
    	$year = date('o');

    	if($request->has('year'))
    	{
    		$year = $request->input('year');
    	}


        

    	return AncestralDomain::where('year', $year)->get();
    }

    public function createAncestralDomain(Request $request)
    {
    	$create = AncestralDomain::create([
    		'name_address' => $request->input('name_address'),
			'ethnolinguistic' => $request->input('ethnolinguistic'),
			'estimated_area' => $request->input('estimated_area'),
			'year' => $request->input('year'),
    	]);

    	return 'success';
    }

    public function updateAncestralDomain(Request $request)
    {
    	$update = AncestralDomain::where('id', $request->input('id'))
				    	->update([
				    		'name_address' => $request->input('name_address'),
							'ethnolinguistic' => $request->input('ethnolinguistic'),
							'estimated_area' => $request->input('estimated_area'),
							'year' => $request->input('year'),
				    	]);

    	return 'success';
    }

    public function deleteAncestralDomain(Request $request)
    {
    	$delete = AncestralDomain::where('id', $request->input('id'))->delete();
        return 'success';
    }

    public function getPopulationByCensusYear()
    {
        $info = PopulationByCensusYear::join('municipalities','municipalities.id','=','population_by_census_years.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','population_by_census_years.*','municipalities.district')
                            ->get();
        $arr["data"] = [];
        $arr["year"] = [];

        $years = PopulationByCensusYear::groupBy('year')->get();
        $year = [];
        foreach ($years as $value) {
            $year[] = $value->year;
        }

        foreach ($info as  $value) {
            $arr["data"][$value->municipality_name][] = [
                'year' => $value->year,
                'id' => $value->id,
                'population' => $value->population,
            ];
        }
        $arr["year"] = $year;
        return $arr;
    }

    public function createPopulationByCensusYear(Request $request)
    {
        foreach (Municipality::get() as $value) {

            $check = PopulationByCensusYear::where([
                'year' => $request->input('year'),
                'municipality' => $value->id,
            ])->first();


            if(!$check)
            {
                $create = PopulationByCensusYear::create([
                    'municipality' => $value->id,
                    'population' => 0,
                    'year' => $request->input('year'),
                ]);
            }
        }
        return 'true';
    }

    public function updatePopulationByCensusYear(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as  $value) {
            foreach ($value as $info) {
                $update = PopulationByCensusYear::where('id', $info["id"])
                                        ->update(['population' => $info["population"]]);
            }
        }
        return 'success';
    }

    public function getHouseholdPopulationBySex()
    {
        $info = HouseholdPopulationBySex::join('municipalities','municipalities.id','=','household_population_by_sexes.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','household_population_by_sexes.*','municipalities.district')
                            ->get();
        $arr["data"] = [];
        $arr["year"] = [];

        $years = HouseholdPopulationBySex::groupBy('year')->get();
        $year = [];
        foreach ($years as $value) {
            $year[] = $value->year;
        }

        foreach ($info as  $value) {
            $arr["data"][$value->municipality_name][] = [
                'year' => $value->year,
                'id' => $value->id,
                'female' => $value->female,
                'male' => $value->male,
            ];
        }
        $arr["year"] = $year;
        return $arr;
    }


    public function createHouseholdPopulationBySex(Request $request)
    {
        foreach (Municipality::get() as $value) {

            $check = HouseholdPopulationBySex::where([
                'year' => $request->input('year'),
                'municipality' => $value->id,
            ])->first();


            if(!$check)
            {
                $create = HouseholdPopulationBySex::create([
                    'municipality' => $value->id,
                    'female' => 0,
                    'male' => 0,
                    'year' => $request->input('year'),
                ]);
            }
        }
        return 'true';
    }


    public function updateHouseholdPopulationBySex(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as  $value) {
            foreach ($value as $info) {
                $update = HouseholdPopulationBySex::where('id', $info["id"])
                                        ->update([
                                                'female' => $info["female"],
                                                'male' => $info["male"]
                                            ]);
            }
        }
        return 'success';
    }

    public function getMangyanTribe(Request $request){
        return MangyanTribe::get();
    }
    
    public function createMangyanTribe(Request $request){
        $create = MangyanTribe::create([
            'mangyan_tribe' => $request->input('mangyan_tribe'),
            'description' => $request->input('description'),
        ]);
        return 'success';
    }

    public function updateMangyanTribe(Request $request){
        $update =  MangyanTribe::where('id', $request->input('id'))->update([
            'mangyan_tribe' => $request->input('mangyan_tribe'),
            'description' => $request->input('description'),
        ]);
        return 'success';
    }

    public function deleteMangyanTribe(Request $request){
        $delete =  MangyanTribe::where('id', $request->input('id'))->delete();
        return 'success';
    }
}
