<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegisteredVehicle;
use App\WaterSystem;
use App\Communication;
use App\Municipality;
use App\StatusOfPower;
use App\EnergizedUnergizedBarangay;
use App\HouseholdPopulationBySourceOfDrinkingWater;
use App\PresentSourceOfPower;
use App\PowerSubstation;
use App\CableTelevisionNetwork;
use App\RadioStation;
use App\SatelliteTelevisionNetwork;
use App\LicensePermitIssued;


class InfrastructureUtilitiesController extends Controller
{
    public function getRegisteredVehicle(Request $request){
    	if($request->has('year'))
    	{
    		return $this->defaultRegisteredVehicle($request->input('year'));

    	}else{
    		return $this->defaultRegisteredVehicle(date('o'));
    	}
    }

    public function defaultRegisteredVehicle($year)
    {
    	$check = RegisteredVehicle::where('year', $year)->get();

    	if(count($check) <= 0)
    	{
    		for ($i=1; $i < 13; $i++) { 
    			$create = RegisteredVehicle::create([
    				'month' => $i,
					'year' => $year
    			]);
    		}
    	}
    	return RegisteredVehicle::where('year', $year)->get();
    }

    public function updateRegisteredVehicle(Request $request)
    {
    	$data = $request->input('data');
    	foreach ($data as $value) 
    	{
    		$update = RegisteredVehicle::where('id', $value["id"])
							->update([
								'cars' => $value['cars'] ?? 0,
								'suv_uv' => $value['suv_uv'] ?? 0,
								'tricycle' => $value['tricycle'] ?? 0,
								'truck' => $value['truck'] ?? 0,
								'truck_bus' => $value['truck_bus'] ?? 0,
								'motorcycle' => $value['motorcycle'] ?? 0,
								'uv_jeep' => $value['uv_jeep'] ?? 0,
							]);
		}

		return 'success';
    }


     public function getWaterSystem(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }

        $water = WaterSystem::where('year', $year)
                                    ->join('municipalities', 'municipalities.id','=','water_systems.municipality')
                                    ->select('water_systems.*','municipalities.id as municipality_id','municipalities.municipality as municipality')
                                    ->get();
        $arr = [];
        foreach ($water as $value) {
            $arr[$value->municipality][] = [
                'id' => $value->id,
                'municipality_name' => $value->municipality,
                'municipality' => $value->municipality_id,
                'water_service_provider' => $value->water_service_provider,
                'type_of_water_facility' => $value->type_of_water_facility,
                'year' => $value->year,
            ];
        }

        return $arr;
    }

    public function createWaterSystem(Request $request)
    {
        $create = WaterSystem::create([
            'municipality' => $request->input('municipality'),
            'water_service_provider' => $request->input('water_service_provider'),
            'type_of_water_facility' => $request->input('type_of_water_facility'),
            'year' => $request->input('year'),
        ]);

        return 'success';
    }

    public function updateWaterSystem(Request $request)
    {
        $update = WaterSystem::where('id', $request->input('id'))
                        ->update([
                            'municipality' => $request->input('municipality'),
                            'water_service_provider' => $request->input('water_service_provider'),
                            'type_of_water_facility' => $request->input('type_of_water_facility'),
                            'year' => $request->input('year'),
                        ]);
        return 'success';
    }
    public function getCommunication(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return $this->createCommunication($year);
    }

    public function createCommunication($year)
    {
        $check = Communication::where('year', $year)->get();

        if(count($check) <= 0)
        {
            $municipality = Municipality::get();

            foreach ($municipality as $value) {
                $create = Communication::create([
                    'municipality' => $value->id,
                    'smart_communication' => 0,
                    'globe_telecom' => 0,
                    'year' => $year,
                ]);
            } 
        }

        return Communication::where('year', $year)
                            ->join('municipalities','municipalities.id','=','communications.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','communications.*','municipalities.district')
                            ->get();
    }

    public function updateCommunication(Request $request)
    {
        $arr = $request->input('data');

        foreach ($arr as $value) {
            $update = Communication::where('id', $value['id'])
                                ->update([
                                    'smart_communication' => $value["smart_communication"],
                                    'globe_telecom' => $value["globe_telecom"],
                                ]);
        }
        return 'success';
    }
    public function getStatusOfPower(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return $this->createStatusOfPower($year);
    }

    public function createStatusOfPower($year)
    {
        $check = StatusOfPower::where('year', $year)->get();

        if(count($check) <= 0)
        {
            $municipality = Municipality::get();

            foreach ($municipality as $value) {
                $create = StatusOfPower::create([
                    'municipality' => $value->id,
                    'barangay_covered' => 0,
                    'barangay_energized' => 0,
                    'sitios_energized' => 0,
                    'sitios_unerginized' => 0,
                    'house_connections' => 0,
                    'members_approved' => 0,
                    'year' => $year,
                ]);
            } 
        }

        return StatusOfPower::where('year', $year)
                            ->join('municipalities','municipalities.id','=','status_of_powers.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','status_of_powers.*','municipalities.district')
                            ->get();
    }

    public function updateStatusOfPower(Request $request)
    {
        $arr = $request->input('data');

        foreach ($arr as $value) {
            $update = StatusOfPower::where('id', $value['id'])
                                ->update([
                                    'barangay_covered' => $value["barangay_covered"],
                                    'barangay_energized' => $value["barangay_energized"],
                                    'sitios_energized' => $value["sitios_energized"],
                                    'sitios_unerginized' => $value["sitios_unerginized"],
                                    'house_connections' => $value["house_connections"],
                                    'members_approved' => $value["members_approved"],
                                ]);
        }
        return 'success';
    }

    public function getEnergizedUnergizedBarangay(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return $this->createEnergizedUnergizedBarangay($year);
    }

    public function createEnergizedUnergizedBarangay($year)
    {
        $check = EnergizedUnergizedBarangay::where('year', $year)->get();

        if(count($check) <= 0)
        {
            $municipality = Municipality::get();

            foreach ($municipality as $value) {
                $create = EnergizedUnergizedBarangay::create([
                    'municipality' => $value->id,
                    'potential' => 0,
                    'energized' => 0,
                    'year' => $year,
                ]);
            } 
        }

        return EnergizedUnergizedBarangay::where('year', $year)
                            ->join('municipalities','municipalities.id','=','energized_unergized_barangays.municipality')
                            ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','energized_unergized_barangays.*','municipalities.district')
                            ->get();
    }

    public function updateEnergizedUnergizedBarangay(Request $request)
    {
        $arr = $request->input('data');

        foreach ($arr as $value) {
            $update = EnergizedUnergizedBarangay::where('id', $value['id'])
                                ->update([
                                    'municipality' => $value["municipality"],
                                    'potential' => $value["potential"],
                                    'energized' => $value["energized"],
                                ]);
        }
        return 'success';
    }


    public function getHouseholdPopulationBySourceOfDrinkingWater(Request $request)
    {
        $year = date('o');
        if($request->has('year'))
        {
            $year = $request->input('year');
        }
        return HouseholdPopulationBySourceOfDrinkingWater::where('year', $year)->get();
    }

    public function createHouseholdPopulationBySourceOfDrinkingWater(Request $request)
    {
        $create = HouseholdPopulationBySourceOfDrinkingWater::create([
            'source_of_drinking' => $request->input('source_of_drinking'),
            'magnitude' => $request->input('magnitude'),
            'proportion' => $request->input('proportion'),
            'year' => $request->input('year'),
        ]);
        return 'success';
    }

    public function updateHouseholdPopulationBySourceOfDrinkingWater(Request $request)
    {
        $update = HouseholdPopulationBySourceOfDrinkingWater::where('id', $request->input('id'))
                        ->update([
                            'source_of_drinking' => $request->input('source_of_drinking'),
                            'magnitude' => $request->input('magnitude'),
                            'proportion' => $request->input('proportion'),
                        ]);
        return 'success';
    }


    public function deleteHouseholdPopulationBySourceOfDrinkingWater(Request $request)
    {
        $delete = HouseholdPopulationBySourceOfDrinkingWater::where('id', $request->input('id'))
                                ->delete();
        return 'success';
    }

    public function getPresentSourceOfPower(Request $request)
    {
        $year = date('o');

        if($request->has('year'))
        {
            $year = $request->input('year');
        }

        return PresentSourceOfPower::where('year', $year)
                                        ->join('municipalities','municipalities.id','=','present_source_of_powers.municipality')
                                        ->select('municipalities.id as municipality','municipalities.municipality as municipality_name','present_source_of_powers.*','municipalities.district')->get();
    }

    public function createPresentSourceOfPower(Request $request)
    {
        $create = PresentSourceOfPower::create([
                                            'power_plant' => $request->input('power_plant'),
                                            'installed_capacity' => $request->input('installed_capacity'),
                                            'dependable_capacity' => $request->input('dependable_capacity'),
                                            'municipality' => $request->input('municipality'),
                                            'year' => $request->input('year')
                                        ]);
        return 'success';
    }

    public function updatePresentSourceOfPower(Request $request)
    {
         $update = PresentSourceOfPower::where('id', $request->input('id'))
                                    ->update([
                                        'power_plant' => $request->input('power_plant'),
                                        'installed_capacity' => $request->input('installed_capacity'),
                                        'dependable_capacity' => $request->input('dependable_capacity'),
                                        'municipality' => $request->input('municipality'),
                                        'year' => $request->input('year'),
                                    ]);
        return 'success';
    }

    public function deletePresentSourceOfPower(Request $request)
    {
        $delete = PresentSourceOfPower::where('id', $request->input('id'))->delete();
        return 'success';
    }

    public function getPowerSubstation(Request $request)
    {
        $year = date('o');
        if($request->has('year'))
        {
            $year = $request->input('year');
        }

        return PowerSubstation::where('year', $year)->get();
    }
    public function createPowerSubstation(Request $request)
    {
        $create = PowerSubstation::create([
            'power_substation' => $request->input('power_substation'),
            'megavolt_amperes' => $request->input('megavolt_amperes'),
            'ownership' => $request->input('ownership'),
            'year' => $request->input('year'),
        ]);
        return 'success';
    }
    public function updatePowerSubstation(Request $request)
    {
          $create = PowerSubstation::where('id', $request->input('id'))
                                  ->update([
                                    'power_substation' => $request->input('power_substation'),
                                    'megavolt_amperes' => $request->input('megavolt_amperes'),
                                    'ownership' => $request->input('ownership'),
                                ]);
        return 'success';
    }
    public function deletePowerSubstation(Request $request)
    {
        $delete = PowerSubstation::where('id', $request->input('id'))->delete();
        return 'success';
    }

    public function getSatelliteTelevisionNetwork()
    {
        return SatelliteTelevisionNetwork::get();
    }
    public function createSatelliteTelevisionNetwork(Request $request)
    {
        $create = SatelliteTelevisionNetwork::create([
            'name' => $request->input('name'),
            'year' => $request->input('year'),
        ]);
        return 'success';
    }
    public function updateSatelliteTelevisionNetwork(Request $request)
    {
        
        $update = SatelliteTelevisionNetwork::where('id', $request->input('id'))
                        ->update([
                            'name' => $request->input('name'),
                            'year' => $request->input('year'),
                        ]);
        return 'success';
    }
    public function deleteSatelliteTelevisionNetwork(Request $request)
    {
        $delete = SatelliteTelevisionNetwork::where('id', $request->input('id'))->delete();
        return 'success';
    }
    public function getRadioStation()
    {
        return RadioStation::get();
    }
    public function createRadioStation(Request $request)
    {
        $create = RadioStation::create([
            'name' => $request->input('name'),
            'year' => $request->input('year'),
        ]);
        return 'success';
    }
    public function updateRadioStation(Request $request)
    {
        
        $update = RadioStation::where('id', $request->input('id'))
                        ->update([
                            'name' => $request->input('name'),
                            'year' => $request->input('year'),
                        ]);
        return 'success';
    }
    public function deleteRadioStation(Request $request)
    {
        $delete = RadioStation::where('id', $request->input('id'))->delete();
        return 'success';
    }
    
    public function getCableTelevisionNetwork()
    {
        return CableTelevisionNetwork::get();
    }
    public function createCableTelevisionNetwork(Request $request)
    {
        $create = CableTelevisionNetwork::create([
            'name' => $request->input('name'),
            'year' => $request->input('year'),
        ]);
        return 'success';
    }
    public function updateCableTelevisionNetwork(Request $request)
    {
        
        $update = CableTelevisionNetwork::where('id', $request->input('id'))
                        ->update([
                            'name' => $request->input('name'),
                            'year' => $request->input('year'),
                        ]);
        return 'success';
    }
    public function deleteCableTelevisionNetwork(Request $request)
    {
        $delete = CableTelevisionNetwork::where('id', $request->input('id'))->delete();
        return 'success';
    }

    public function getLicensePermitIssued(Request $request)
    {
        $year = date('o');
        if($request->has('year'))
        {
            $year = $request->input('year');
        }

        return $this->createLicensePermitIssued($year);
    }

    public function createLicensePermitIssued($year)
    {
        $check = LicensePermitIssued::where('year', $year)->get();
        if(count($check) <=0)
        {
            LicensePermitIssued::create([
                'year' => $year
            ]);
        }
        return LicensePermitIssued::where('year', $year)->first();
    }

    public function updateLicensePermitIssued(Request $request)
    {
        $update = LicensePermitIssued::where('id', $request->input('id'))
            ->update([
                'pro_new_first_sem' => $request->input('pro_new_first_sem'),
                'pro_new_second_sem' => $request->input('pro_new_second_sem'),
                'pro_renew_first_sem' => $request->input('pro_renew_first_sem'),
                'pro_renew_second_sem' => $request->input('pro_renew_second_sem'),
                'non_pro_new_first_sem' => $request->input('non_pro_new_first_sem'),
                'non_pro_new_second_sem' => $request->input('non_pro_new_second_sem'),
                'non_pro_renew_first_sem' => $request->input('non_pro_renew_first_sem'),
                'non_pro_renew_second_sem' => $request->input('non_pro_renew_second_sem'),
                'student_first_sem' => $request->input('student_first_sem'),
                'student_second_sem' => $request->input('student_second_sem'),
            ]);
            return 'success';
    }
}
