<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RiceAreaCity;
use App\Municipality;
use App\IrrigatedArea;
use App\RiceProduction;
use App\CornProduction;
use App\VegetableProduction;
use App\CoconutProduction;
use App\HighValueCommercialCrop;
use App\AccommodationEstablishment;
use App\TouristSitesAndDestination;
use App\BanksAndAtm;
use App\CommerceAndIndustry;
use App\TopFiveProduct;
use App\TopFiveFruitArea;


class EconomicProfileController extends Controller
{
    public function getRiceAreaCity(Request $request)
    {
    	$year = date('o');

    	if($request->has('year'))
    	{
    		$year = $request->input('year');
    	}
    	return $this->createRiceAreaCity($year);
    }

    public function createRiceAreaCity($year)
    {
    	$check = RiceAreaCity::where('year', $year)->get();

    	if(count($check) <= 0)
    	{
    		$municipality = Municipality::get();

    		foreach ($municipality as $value) {
    		 	$create = RiceAreaCity::create([
    		 		'municipality' => $value->id,
					'irrigated_area' => 0,
					'rainfed_area' => 0,
					'total_rice_area' => 0,
					'year' => $year,
    		 	]);
    		} 
    	}

    	return RiceAreaCity::where('year', $year)
                            ->join('municipalities','municipalities.id','=','rice_area_cities.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','rice_area_cities.*','municipalities.district')
                            ->get();
    }

    public function updateRiceAreaCity(Request $request)
    {
    	$arr = $request->input('data');

    	foreach ($arr as $value) {
    		$update = RiceAreaCity::where('id', $value['id'])
    							->update([
									'irrigated_area' => $value["irrigated_area"],
									'rainfed_area' => $value["rainfed_area"],
									'total_rice_area' => $value["total_rice_area"],
    							]);
    	}
    	return 'success';
    }

    public function getIrrigatedArea(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return $this->createIrrigatedArea($year);
    }

    public function createIrrigatedArea($year)
    {
        $count = IrrigatedArea::where('year', $year)->get();

        if(count($count) <= 0)
        {
            $municipality = Municipality::get();
            foreach ($municipality as $value) {
                $create = IrrigatedArea::create([
                    'municipality' => $value->id,
                    'ris' => 0,
                    'cis' => 0,
                    'pump' => 0,
                    'total' => 0,
                    'year' => $year,
                ]);
            }
        }

        return IrrigatedArea::where('year', $year)
                            ->join('municipalities','municipalities.id','=','irrigated_areas.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','irrigated_areas.*','municipalities.district')
                            ->get();
    }

    public function updateIrrigatedArea(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $value) {
            $update = IrrigatedArea::where('id', $value["id"])
                        ->update([
                            'ris' => $value["ris"],
                            'cis' => $value["cis"],
                            'pump' => $value["pump"],
                            'total' => $value["total"],
                        ]);
        }

        return 'success';
    }

    public function getRiceProduction(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return $this->createRiceProduction($year);
    }

    public function createRiceProduction($year)
    {
        $check = RiceProduction::where('year', $year)->get();
        if(count($check) <= 0)
        {
            foreach (Municipality::get() as $value) {
               RiceProduction::create([
                'municipality' => $value->id,
                'no_of_farmers' => 0,
                'area_harvested' => 0,
                'production_mt' => 0,
                'arerage_yield' => 0,
                'year' => $year,
               ]);
            }
        }

        return RiceProduction::where('year', $year)
                            ->join('municipalities','municipalities.id','=','rice_productions.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','rice_productions.*','municipalities.district')
                            ->get();
    }

    public function updateRiceProduction(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $value) {
            RiceProduction::where('id', $value["id"])
                            ->update([
                                'municipality' => $value["municipality"],
                                'no_of_farmers' => $value["no_of_farmers"],
                                'area_harvested' => $value["area_harvested"],
                                'production_mt' => $value["production_mt"],
                                'arerage_yield' => $value["arerage_yield"],
                            ]);
        }
        return 'success';
    }


    public function getCornProduction(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return $this->createCornProduction($year);
    }

    public function createCornProduction($year)
    {
        $check = CornProduction::where('year', $year)->get();
        if(count($check) <= 0)
        {
            foreach (Municipality::get() as $value) {
               CornProduction::create([
                'municipality' => $value->id,
                'no_of_farmers' => 0,
                'area_harvested' => 0,
                'production_mt' => 0,
                'arerage_yield' => 0,
                'year' => $year,
               ]);
            }
        }

        return CornProduction::where('year', $year)
                            ->join('municipalities','municipalities.id','=','corn_productions.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','corn_productions.*','municipalities.district')
                            ->get();
    }

    public function updateCornProduction(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $value) {
            CornProduction::where('id', $value["id"])
                            ->update([
                                'municipality' => $value["municipality"],
                                'no_of_farmers' => $value["no_of_farmers"],
                                'area_harvested' => $value["area_harvested"],
                                'production_mt' => $value["production_mt"],
                                'arerage_yield' => $value["arerage_yield"],
                            ]);
        }
        return 'success';
    }


    public function getVegetableProduction(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return $this->createVegetableProduction($year);
    }

    public function createVegetableProduction($year)
    {
        $check = VegetableProduction::where('year', $year)->get();
        if(count($check) <= 0)
        {
               VegetableProduction::create([
                'commodity' => "Root Crops",
                'area_harvested' => 0,
                'production_mt' => 0,
                'arerage_yield' => 0,
                'year' => $year,
               ]);
               VegetableProduction::create([
                'commodity' => "Fruit Vegetables",
                'area_harvested' => 0,
                'production_mt' => 0,
                'arerage_yield' => 0,
                'year' => $year,
               ]);
               VegetableProduction::create([
                'commodity' => "Leafy Vegetables",
                'area_harvested' => 0,
                'production_mt' => 0,
                'arerage_yield' => 0,
                'year' => $year,
               ]);
               VegetableProduction::create([
                'commodity' => "Legumes",
                'area_harvested' => 0,
                'production_mt' => 0,
                'arerage_yield' => 0,
                'year' => $year,
               ]);
               VegetableProduction::create([
                'commodity' => "Condiments",
                'area_harvested' => 0,
                'production_mt' => 0,
                'arerage_yield' => 0,
                'year' => $year,
               ]);
        }

        return VegetableProduction::where('year', $year)
                            ->get();
    }

    public function updateVegetableProduction(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $value) {
            VegetableProduction::where('id', $value["id"])
                            ->update([
                                'area_harvested' => $value["area_harvested"],
                                'production_mt' => $value["production_mt"],
                                'arerage_yield' => $value["arerage_yield"],
                            ]);
        }
        return 'success';
    }

    public function getCoconutProduction(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return $this->createCoconutProduction($year);
    }

    public function createCoconutProduction($year)
    {
        $check = CoconutProduction::where('year', $year)->get();
        if(count($check) <= 0)
        {
            foreach (Municipality::get() as $value) {
               CoconutProduction::create([
                'municipality' => $value->id,
                'no_of_coconut_farmers' => 0,
                'coconut_area' => 0,
                'no_of_coco_trees' => 0,
                'non_bearing' => 0,
                'bearing' => 0,
                'nut_tree_year' => 0,
                'wholenuts' => 0,
                'copra_equivalent' => 0,
                'year' => $year,
               ]);
            }
        }

        return CoconutProduction::where('year', $year)
                            ->join('municipalities','municipalities.id','=','coconut_productions.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','coconut_productions.*','municipalities.district')
                            ->get();
    }

    public function updateCoconutProduction(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $value) {
            CoconutProduction::where('id', $value["id"])
                            ->update([
                                'no_of_coconut_farmers' => $value['no_of_coconut_farmers'],
                                'coconut_area' => $value['coconut_area'],
                                'no_of_coco_trees' => $value['no_of_coco_trees'],
                                'non_bearing' => $value['non_bearing'],
                                'bearing' => $value['bearing'],
                                'nut_tree_year' => $value['nut_tree_year'],
                                'wholenuts' => $value['wholenuts'],
                                'copra_equivalent' => $value['copra_equivalent'],
                            ]);
        }
        return 'success';
    }

    public function getHighValueCommercialCrop(Request $request)
    {
        $year = date('o');
        if($request->has('year'))
        {
            $year = $request->input('year');
        }

        return HighValueCommercialCrop::where('year', $year)->get();
    }

    public function createHighValueCommercialCrop(Request $request)
    {
        $validate = $request->validate([
            'commodity' => 'required',
            'year' => 'required',
        ]);

        $create = HighValueCommercialCrop::create([
            'commodity' => $request->input('commodity'),
            'year' => $request->input('year')
        ]);
    }

    public function updateHighValueCommercialCrop(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $value) {
            $crops = HighValueCommercialCrop::where('id', $value["id"])
                            ->update([
                                'commodity' => $value["commodity"],
                                'farmers_served' => $value["farmers_served"],
                                'no_of_trees_planted' => $value["no_of_trees_planted"],
                                'planted_area' => $value["planted_area"],
                                'production' => $value["production"],
                                'average_yield' => $value["average_yield"],
                            ]);
        }
        return 'success';
    }

    public function deleteHighValueCommercialCrop(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required'
        ]);

        $delete = HighValueCommercialCrop::where('id', $request->input('id'))->delete();
    }





    // ACCOMODATION
    public function getAccommodationEstablishment(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return $this->createAccommodationEstablishment($year);
    }

    public function createAccommodationEstablishment($year)
    {
        $check = AccommodationEstablishment::where('year', $year)->get();
        if(count($check) <= 0)
        {
            foreach (Municipality::get() as $value) {
               AccommodationEstablishment::create([
                'municipality' => $value->id,
                'no_of_accommodation_establishment' => 0,
                'no_of_room' => 0,
                'bedding_capacity' => 0,
                'total_employment' => 0,
                'year' => $year,
               ]);
            }
        }

        return AccommodationEstablishment::where('year', $year)
                            ->join('municipalities','municipalities.id','=','accommodation_establishments.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','accommodation_establishments.*','municipalities.district')
                            ->get();
    }

    public function updateAccommodationEstablishment(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $value) {
            AccommodationEstablishment::where('id', $value["id"])
                            ->update([
                                'no_of_accommodation_establishment' => $value["no_of_accommodation_establishment"],
                                'no_of_room' => $value["no_of_room"],
                                'bedding_capacity' => $value["bedding_capacity"],
                                'total_employment' => $value["total_employment"],
                            ]);
        }
        return 'success';
    }

    public function getTouristSitesAndDestination(Request $request)
    {
        $tourist = TouristSitesAndDestination::join('municipalities','municipalities.id','=','tourist_sites_and_destinations.municipality')
                                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','tourist_sites_and_destinations.*','municipalities.district')
                                            ->get();
        $arr = [];
        foreach ($tourist as  $value) 
        {
            $arr[$value->municipality_name][] = [
                'id' => $value->id,
                'municipality' => $value->municipality,
                'destination' => $value->destination,
            ];
        }
        return $arr;
    }

    public function createTouristSitesAndDestination(Request $request)
    {
        $validate = $request->validate([
            'municipality' => 'required',
            'destination' => 'required',
        ]);

        $create = TouristSitesAndDestination::create([
            'municipality' => $request->input('municipality'),
            'destination' => $request->input('destination'),
        ]);

        return 'success';
    }

    public function updateTouristSitesAndDestination(Request $request)
    {

        $validate = $request->validate([
            'municipality' => 'required',
            'destination' => 'required',
        ]);

        $update = TouristSitesAndDestination::where('id', $request->input('id'))
                            ->update([
                                'municipality' => $request->input('municipality'),
                                'destination' => $request->input('destination'),
                            ]);
        return 'success';

    }

    public function deleteTouristSitesAndDestination(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required',
        ]);

        $delete = TouristSitesAndDestination::where('id', $request->input('id'))->delete();
        return 'success';
    }


    public function getBanksAndAtm(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return $this->createBanksAndAtm($year);
    }

    public function createBanksAndAtm($year)
    {
        $check = BanksAndAtm::where('year', $year)->get();
        if(count($check) <= 0)
        {
            foreach (Municipality::get() as $value) {
               BanksAndAtm::create([
                    'municipality' => $value->id,
                    'banks' => 0,
                    'atm' => 0,
                    'year' => $year,
               ]);
            }
        }
        return BanksAndAtm::where('year', $year)
                            ->join('municipalities','municipalities.id','=','banks_and_atms.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','banks_and_atms.*','municipalities.district')
                            ->get();
    }

    public function updateBanksAndAtm(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $value) {
            BanksAndAtm::where('id', $value["id"])
                            ->update([
                                'banks' => $value["banks"],
                                'atm' => $value["atm"],
                            ]);
        }
        return 'success';
    }


    public function getCommerceAndIndustry(Request $request)
    {
        $year = date('o');
        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return $this->createCommerceAndIndustry($year);
    }

    public function createCommerceAndIndustry($year)
    {
        $arr = ['Services','Trading','Tourism','Manufacturing','Agriculture'];

        $check = CommerceAndIndustry::where('year', $year)->get();
        if(count($check) <= 0)
        {
            foreach ($arr as $value) {
                CommerceAndIndustry::create([
                    'sectoral_classification' => $value,
                    'no_of_applications' => 0,
                    'investments' => 0,
                    'employment' => 0,
                    'year' => $year,
                ]);
            }
        }
        return CommerceAndIndustry::where('year', $year)->get();
    }


    public function updateCommerceAndIndustry(Request $request)
    {
        $data = $request->input('data');
        
        foreach ($data as $value) {
           $update = CommerceAndIndustry::where('id', $value["id"])
                            ->update([
                                'sectoral_classification' => $value["sectoral_classification"],
                                'no_of_applications' => $value["no_of_applications"],
                                'investments' => $value["investments"],
                                'employment' => $value["employment"],
                            ]);
        }

        return 'success';
    }

    public function getTopFiveProduct(Request $request)
    {
        $year = date('o');
        if($request->has('year'))
        {
            $year = $request->input('year');
        }

        $topfive = TopFiveProduct::where('year', $year)
                                    ->join('municipalities','municipalities.id','=','top_five_products.municipality')
                                    ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','top_five_products.*','municipalities.district')
                                    ->get();
        $arr = [];
        $arr["data"] = [];
        $arr["product_name"] = [];
        $arr["year"] = $year;


        foreach ($topfive as $value) {
            $arr["product_name"][$value->product] = [];
            $arr["data"][$value->municipality_name][$value->product] = [
                'id' => $value->id,
                'product' => $value->product,
                'quantity' => $value->quantity,
                'year' => $value->year,
            ];
        }
        return $arr;
    }
    public function createTopFiveProduct(Request $request)
    {
        foreach (Municipality::get() as $value) {
            TopFiveProduct::create([
                'municipality' => $value->id,
                'product' => $request->input('product'),
                'quantity' => 0,
                'year' => $request->input('year'),
            ]);
        }
        return 'success';
    }
    public function updateTopFiveProduct(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $municipality_arr) {
            foreach ($municipality_arr as $product_arr) {
                TopFiveProduct::where('id', $product_arr["id"])
                            ->update([
                                'quantity' => $product_arr["quantity"],
                            ]);
            }
        }
        return 'success';
    }
    public function deleteTopFiveProduct(Request $request)
    {
        $delete = TopFiveProduct::where([
                                        'product' => $request->input('product'),
                                        'year' => $request->input('year'),
                                    ])->delete();
        return 'success';
    }


    public function getTopFiveFruitArea(Request $request)
    {
        $year = date('o');
        if($request->has('year'))
        {
            $year = $request->input('year');
        }

        $topfive = TopFiveFruitArea::where('year', $year)
                                    ->join('municipalities','municipalities.id','=','top_five_fruit_areas.municipality')
                                    ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','top_five_fruit_areas.*','municipalities.district')
                                    ->get();
        $arr = [];
        $arr["data"] = [];
        $arr["product_name"] = [];
        $arr["year"] = $year;


        foreach ($topfive as $value) {
            $arr["product_name"][$value->product] = [];
            $arr["data"][$value->municipality_name][$value->product] = [
                'id' => $value->id,
                'product' => $value->product,
                'quantity' => $value->quantity,
                'year' => $value->year,
            ];
        }
        return $arr;
    }
    public function createTopFiveFruitArea(Request $request)
    {
        foreach (Municipality::get() as $value) {
            TopFiveFruitArea::create([
                'municipality' => $value->id,
                'product' => $request->input('product'),
                'quantity' => 0,
                'year' => $request->input('year'),
            ]);
        }
        return 'success';
    }
    public function updateTopFiveFruitArea(Request $request)
    {
        $data = $request->input('data');

        foreach ($data as $municipality_arr) {
            foreach ($municipality_arr as $product_arr) {
                TopFiveFruitArea::where('id', $product_arr["id"])
                            ->update([
                                'quantity' => $product_arr["quantity"],
                            ]);
            }
        }
        return 'success';
    }
    public function deleteTopFiveFruitArea(Request $request)
    {
        $delete = TopFiveFruitArea::where([
                                        'product' => $request->input('product'),
                                        'year' => $request->input('year'),
                                    ])->delete();
        return 'success';
    }


}
