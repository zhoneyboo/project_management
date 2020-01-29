<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LandAreaByMunicipality;
use App\Municipality;
use App\LandClassificationStatistic;
use App\GeographicalZoneSurfaces;
use App\NonMetallicMineral;
use App\MajorWatershed;
use App\CoastalResource;
use App\EstablishedMarineProtectedArea;
use App\ForestCover;
use App\MetallicMineralResource;

class LandAndOtherNaturalResourcesController extends Controller
{

     public function getLandAreaByMunicipality(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }

        return $this->createLandAreaByMunicipality($year);
    }

    public function createLandAreaByMunicipality($year)
    {
        $check = LandAreaByMunicipality::where('year', $year)->get();

        if(count($check) <= 0)
        {
            $municipality = Municipality::get();
            foreach ($municipality as $key => $value) {
                $addLandArea = LandAreaByMunicipality::create([
                        'municipality' => $value->id,
                        'land_area' => 0,
                        'year' => $year,
                    ]); 
            }
        }

        return LandAreaByMunicipality::where('year', $year)->join('municipalities','municipalities.id','=','land_area_by_municipalities.municipality')->select('land_area_by_municipalities.*','municipalities.municipality','municipalities.district',"municipalities.id as municipality_id")->get();
    }

    public function updateLandAreaMuniticipalty(Request $request)
    {
         $data = $request->input('data');

         foreach ($data as $value) {
             LandAreaByMunicipality::where([
                                                'id' => $value['id'], 
                                            ])
                                     ->update([
                                        'land_area' => $value['land_area']
                                     ]);
         }
         return 'success';
    }


    public function getLandClassificationStatistics(Request $request)
    {
        if($request->has('year'))
        {
        	$land = LandClassificationStatistic::where('year', $request->input('year'))->first();
        	if(is_null($land))
        	{
        		$land = $this->createLandClassificationStatistics($request->input('year'));
        	}
            return $land;
        }
        else
        {
        	$land = LandClassificationStatistic::where('year', date('o'))->first();
        	if(is_null($land))
        	{
        		$land = $this->createLandClassificationStatistics(date('o'));
        	}
            return $land;
        }
    }

    public function createLandClassificationStatistics($year)
    {
    	$land = LandClassificationStatistic::create([
                'certified_alienable_and_disposable_land' => 0,
                'forest_land_classified' => 0,
                'forest_land_unclassified' => 0,
                'year' => $year,
            ]);
    	return $land;
    }

    public function updateLandClassificationStatistics(Request $request)
    {
        $request->validate([
            'certified_alienable_and_disposable_land' => 'required',
            'forest_land_classified' => 'required',
            'forest_land_unclassified' => 'required',
        ]);

        $update = LandClassificationStatistic::where('id', $request->input('id'))
                                                ->update([
                                                    'certified_alienable_and_disposable_land' => $request->input('certified_alienable_and_disposable_land'),
                                                    'forest_land_classified' => $request->input('forest_land_classified'),
                                                    'forest_land_unclassified' => $request->input('forest_land_unclassified'),
                                                ]);
         return 'success';
    }

    public function getGeographicalZoneSurfaces(Request $request)
    {
		if($request->has('year'))
        {
        	$geographic = GeographicalZoneSurfaces::where('year', $request->input('year'))->first();
        	if(is_null($geographic))
        	{
        		$geographic = $this->createGeographicalZoneSurfaces($request->input('year'));
        	}
            return $geographic;
        }
        else
        {
        	$geographic = GeographicalZoneSurfaces::where('year', date('o'))->first();
        	if(is_null($geographic))
        	{
        		$geographic = $this->createGeographicalZoneSurfaces(date('o'));
        	}
            return $geographic;
        }
    }

    public function createGeographicalZoneSurfaces($year){
    	$geo = GeographicalZoneSurfaces::create([
    		'coastal_area' => '324.45 km.',
			'lake_areas' => '81.28 sq. km.',
			'total_land_mass' => '89% of its total land mass',
			'year' => $year,
    	]);
        return $geo;
    }

    public function updateGeographicalZoneSurfaces(Request $request)
    {
        $validate = $request->validate([
            'coastal_area' => 'required',
            'lake_areas' => 'required',
            'total_land_mass' => 'required',
        ]);


        $update = GeographicalZoneSurfaces::where('id', $request->input('id'))
                    ->update([
                        'coastal_area' => $request->input('coastal_area'),
                        'lake_areas' => $request->input('lake_areas'),
                        'total_land_mass' => $request->input('total_land_mass'),
                    ]);
        return 'success';
    }

     public function createNonMetallicMineral($year)
    {

        $check_info = NonMetallicMineral::where('year', $year)->get();

        if(count($check_info) < 1)
        {
            $municipality = Municipality::get();

            foreach ($municipality as $value) {
                $create = NonMetallicMineral::create([
                    'municipality' => $value->id,
                    'cubic_meter' => 0,
                    'amount' => 0,
                    'year' => $year
                ]);
            }
        }
        return NonMetallicMineral::where('year', $year)
                                 ->select('non_metallic_minerals.*','municipalities.municipality','municipalities.district',"municipalities.id as municipality_id")
                                ->join('municipalities','municipalities.id','=','non_metallic_minerals.municipality')
                                ->get();
    }
    
    public function getNonMetallicMineral(Request $request){
        if($request->has('year'))
        {
            return $this->createNonMetallicMineral($request->input('year'));
        }else{
            return $this->createNonMetallicMineral(date('o'));
        }
    }


    public function updateNonMetallicMineral(Request $request)
    {
        $arr = $request->input('data');

        foreach ($arr as $value) {
            $update = NonMetallicMineral::where('id', $value["id"])
                                        ->update([
                                            'cubic_meter' => $value['cubic_meter'],
                                            'amount' => $value['amount'],
                                        ]);
        }
        return 'success';
    }

    public function getMajorWatershed(Request $request)
    {
        if($request->has('year'))
        {
            return MajorWatershed::where('year', $request->input('year'))->get();
        }else{
            return MajorWatershed::where('year', date('o'))->get();
        }
    }

    public function createMajorWatershed(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'year' => 'required',
        ]);
        $create = MajorWatershed::create([
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'classification' => $request->input('classification'),
            'area' => $request->input('area'),
            'year' => $request->input('year'),
        ]);

        return 'success';
    }

    public function updateMajorWatershed(Request $request)
    {
        $update = MajorWatershed::where('id', $request->input('id'))
                                ->update([
                                        'name' => $request->input('name'),
                                        'location' => $request->input('location'),
                                        'classification' => $request->input('classification'),
                                        'area' => $request->input('area'),
                                ]);

        return 'success';
    }

    public function deleteMajorWatershed(Request $request)
    {
        $delete = MajorWatershed::where('id', $request->input('id'))->delete();
        return 'success';
    }
    
    public function getCoastalResource(Request $request)
    {

        if($request->has('year'))
        {
            return $this->createCoastalResource($request->input('year'));
        }else{
            return $this->createCoastalResource(date('o'));
        }
    }

    public function createCoastalResource($year)
    {
        $coastal_resources = CoastalResource::where('year', $year)
                                                ->join('municipalities','municipalities.id','=','coastal_resources.municipality')
                                                ->select('coastal_resources.*', 'municipalities.municipality','municipalities.id as municipality_id')
                                                ->get();

        if(count($coastal_resources) <= 0)
        {
            $municipality = CoastalResource::municipality();

            foreach ($municipality as $value) {
                CoastalResource::create([
                    'municipality' => $value,
                    'municipal_water' => 0,
                    'mpa' => 0,
                    'mpa_percent' => 0,
                    'year' => $year,
                ]);
            }
            $coastal_resources = CoastalResource::where('year', $year)
                                                ->join('municipalities','municipalities.id','=','coastal_resources.municipality')
                                                ->select('coastal_resources.*', 'municipalities.municipality','municipalities.id as municipality_id')
                                                ->get();
        }

        return $coastal_resources;
    }

    public function updateCoastalResource(Request $request)
    {
        $arr = $request->input('data');


        foreach ($arr as  $value) {
             CoastalResource::where('id', $value["id"])
                                ->update([
                                    'municipal_water' =>$value["municipal_water"],
                                    'mpa' =>$value["mpa"],
                                    'mpa_percent' =>$value["mpa_percent"],
                                ]);
        }

        return 'success';
    }

    public function getEstablishedMarineProtectedArea(Request $request)
    {

        $arr = [];
        if($request->has('year'))
        {
            $arr =  EstablishedMarineProtectedArea::join('municipalities','municipalities.id','established_marine_protected_areas.municipality')
                                                ->select('established_marine_protected_areas.*', 'municipalities.municipality as municipality_name')
                                                // ->where('year', $request->input('year'))
                                                ->get();
        }else{
             $arr =  EstablishedMarineProtectedArea::join('municipalities','municipalities.id','established_marine_protected_areas.municipality')
                                                ->select('established_marine_protected_areas.*', 'municipalities.municipality as municipality_name')
                                                // ->where('year', date('o'))
                                                ->get();
        }


        $data = [];

        foreach ($arr as $value) {
           $data[$value->municipality_name][] = [
                'id' => $value->id,
                'municipality' => $value->municipality,
                'name_of_mpa' => $value->name_of_mpa,
                'location' => $value->location,
                'year_stablished' => $value->year_stablished,
                'estimated_area' => $value->estimated_area,
                'year' => $value->year,
           ];
        }
        return $data;
    }

    public function createEstablishedMarineProtectedArea(Request $request)
    {
        $create = EstablishedMarineProtectedArea::create([
            'municipality' => $request->input('municipality'),
            'name_of_mpa' => $request->input('name_of_mpa'),
            'location' => $request->input('location'),
            'year_stablished' => $request->input('year_stablished') ?? 2019,
            'estimated_area' => $request->input('estimated_area'),
            'year' => $request->input('year'),
        ]);
        return 'success';
    }

    public function updateEstablishedMarineProtectedArea(Request $request)
    {
        $update = EstablishedMarineProtectedArea::where('id', $request->input('id'))
                    ->update([
                        'municipality' => $request->input('municipality'),
                        'name_of_mpa' => $request->input('name_of_mpa'),
                        'location' => $request->input('location'),
                        'year_stablished' => $request->input('year_stablished'),
                        'estimated_area' => $request->input('estimated_area'),
                        'year' => $request->input('year'),
                    ]);
    }

    public function deleteEstablishedMarineProtectedArea(Request $request)
    {
        $delete = EstablishedMarineProtectedArea::where('id', $request->input('id'))->delete();
        return 'success';
    }


    public function getForestCover(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return $this->createForestCover($year);
    }

    public function createForestCover($year)
    {
        $count = ForestCover::where('year', $year)->get();
        if(count($count) <= 0)
        {
            $arr = ["Marinduque", "Occidental Mindoro ", "Oriental Mindoro", "Palawan","Romblon"];

            foreach ($arr as $value) {
                $create = ForestCover::create([
                    'province' => $value,
                    'year' => $year,
                ]);
            }
        }

        return ForestCover::where('year', $year)->get();
    }

    public function updateForestCover(Request $request)
    {
        $data = $request->input('data');


        foreach ($data as $value) {
            $update = ForestCover::where('id', $value["id"])
                            ->update([
                                'closed_forest' => $value["closed_forest"],
                                'open_forest' => $value["open_forest"],
                                'mangrove' => $value["mangrove"],
                            ]);
        }
    }


    public function getMetallicMineralResource(Request $request)
    {
        $year = date('o');
        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return MetallicMineralResource::where('year', $year)->get();
    }

    public function createMetallicMineralResource(Request $request)
    {
        $create = MetallicMineralResource::create([
            'mineral' => $request->input('mineral'),
            'municipality' => $request->input('municipality'),
            'year' => $request->input('year'),
        ]);

        return 'success';
    }

    public function updateMetallicMineralResource(Request $request)
    {
        $update = MetallicMineralResource::where('id', $request->input('id'))
                            ->update([
                                'mineral' => $request->input('mineral'),
                                'municipality' => $request->input('municipality'),
                            ]);
        return 'success';
    }

    public function deleteMetallicMineralResource(Request $request)
    {
        $delete = MetallicMineralResource::where('id', $request->input('id'))->delete();
        return 'success';
    }
}
