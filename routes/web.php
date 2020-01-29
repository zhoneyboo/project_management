<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();


Route::get('/', function () {
    return view('welcome');
})->middleware('auth');


Route::get('/error', function () {
    return "success";
});

Route::post('/test/upload', 'FileController@test_upload');


Route::group(['middleware' => ['access:admin','auth']], function(){
	Route::get('/user', function () {return view('welcome');});
});

Route::post('/get_addresses', 'HomeController@get_addresses');

Route::post('/generate_word', 'HomeController@generate_word');

Route::post('/uploadCBMS', 'ExcelController@uploadCBMS');
Route::get('/addBarangay', 'ExcelController@addBarangay');

// SOCIAL DEVELOPMENT

Route::post('/social_development/comparative_labor_force_participation/create', 'SocialDevelopmentController@createComparativeLaborForce');
Route::post('/social_development/comparative_labor_force_participation/get', 'SocialDevelopmentController@getComparativeLaborForce');
Route::post('/social_development/comparative_labor_force_participation/udate', 'SocialDevelopmentController@updateComparativeLaborForce');


Route::post('/social_development/comparative_employment_statuses/create', 'SocialDevelopmentController@createComparativeEmploymentStatus');
Route::post('/social_development/comparative_employment_statuses/get', 'SocialDevelopmentController@getComparativeEmploymentStatus');
Route::post('/social_development/comparative_employment_statuses/udate', 'SocialDevelopmentController@updateComparativeEmploymentStatus');


Route::post('/social_development/poverty_incidences/create', 'SocialDevelopmentController@createPovertyIncidence');
Route::post('/social_development/poverty_incidences/get', 'SocialDevelopmentController@getPovertyIncidence');
Route::post('/social_development/poverty_incidences/udate', 'SocialDevelopmentController@updatePovertyIncidence');


Route::post('/social_development/number_rate_bdimds/get', 'SocialDevelopmentController@getNumberRateBdimd');
Route::post('/social_development/number_rate_bdimds/create', 'SocialDevelopmentController@createNumberRateBdimd');
Route::post('/social_development/number_rate_bdimds/udate', 'SocialDevelopmentController@updateNumberRateBdimd');


Route::post('/social_development/doh_licensed_health_facilities/get', 'SocialDevelopmentController@getDohLicensedHealthFacility');
Route::post('/social_development/doh_licensed_health_facilities/create', 'SocialDevelopmentController@createDohLicensedHealthFacility');
Route::post('/social_development/doh_licensed_health_facilities/update', 'SocialDevelopmentController@updateDohLicensedHealthFacility');
Route::post('/social_development/doh_licensed_health_facilities/delete', 'SocialDevelopmentController@deleteDohLicensedHealthFacility');



Route::post('/social_development/nutritional_status/get', 'SocialDevelopmentController@getNutritionalStatus');
Route::post('/social_development/nutritional_status/update', 'SocialDevelopmentController@updateNutritionalStatus');

Route::post('/social_development/health_facilities/get', 'SocialDevelopmentController@getHealthFacility');
Route::post('/social_development/health_facilities/update', 'SocialDevelopmentController@updateHealthFacility');


Route::post('/social_development/health_personnels/get', 'SocialDevelopmentController@getHealthPersonnel');
Route::post('/social_development/health_personnels/update', 'SocialDevelopmentController@updateHealthPersonnel');

Route::post('/social_development/senior_citizen_and_person_with_disabilities/get', 'SocialDevelopmentController@getSeniorCitizenAndPersonWithDisability');
Route::post('/social_development/senior_citizen_and_person_with_disabilities/update', 'SocialDevelopmentController@updateSeniorCitizenAndPersonWithDisability');


Route::post('/social_development/crime_statistics_and_protective_facilities/get', 'SocialDevelopmentController@getCrimeStatisticsAndProtectiveFacility');
Route::post('/social_development/crime_statistics_and_protective_facilities/update', 'SocialDevelopmentController@updateCrimeStatisticsAndProtectiveFacility');


Route::post('/social_development/education_facilities/get', 'SocialDevelopmentController@getEducationFacilities');
Route::post('/social_development/education_facilities/create', 'SocialDevelopmentController@createEducationFacilities');
Route::post('/social_development/education_facilities/update', 'SocialDevelopmentController@updateEducationFacilities');
Route::post('/social_development/education_facilities/delete', 'SocialDevelopmentController@deleteEducationFacilities');


Route::post('/social_development/enrollment_in_government_and_private_schools/get', 'SocialDevelopmentController@getEnrollmentInGovernmentAndPrivateSchool');
Route::post('/social_development/enrollment_in_government_and_private_schools/update', 'SocialDevelopmentController@updateEnrollmentInGovernmentAndPrivateSchool');


Route::post('/social_development/performance_indicator_in_public_schools/get', 'SocialDevelopmentController@getPerformanceIndicatorInPublicSchool');

Route::post('/social_development/performance_indicator_in_public_schools/update', 'SocialDevelopmentController@updatePerformanceIndicatorInPublicSchool');

Route::post('/social_development/health_morbidities/get', 'SocialDevelopmentController@getHealthMorbidity');
Route::post('/social_development/health_morbidities/create', 'SocialDevelopmentController@createHealthMorbidity');
Route::post('/social_development/health_morbidities/update', 'SocialDevelopmentController@updateHealthMorbidity');
Route::post('/social_development/health_morbidities/delete', 'SocialDevelopmentController@deleteHealthMorbidity');


Route::post('/social_development/health_infant_morbidities/get', 'SocialDevelopmentController@getHealthInfantMorbidity');
Route::post('/social_development/health_infant_morbidities/create', 'SocialDevelopmentController@createHealthInfantMorbidity');
Route::post('/social_development/health_infant_morbidities/update', 'SocialDevelopmentController@updateHealthInfantMorbidity');
Route::post('/social_development/health_infant_morbidities/delete', 'SocialDevelopmentController@deleteHealthInfantMorbidity');



Route::post('/social_development/health_mortalities/get', 'SocialDevelopmentController@getHealthMortality');
Route::post('/social_development/health_mortalities/create', 'SocialDevelopmentController@createHealthMortality');
Route::post('/social_development/health_mortalities/update', 'SocialDevelopmentController@updateHealthMortality');
Route::post('/social_development/health_mortalities/delete', 'SocialDevelopmentController@deleteHealthMortality');

Route::post('/social_development/health_infant_mortalities/get', 'SocialDevelopmentController@getHealthInfantMortality');
Route::post('/social_development/health_infant_mortalities/create', 'SocialDevelopmentController@createHealthInfantMortality');
Route::post('/social_development/health_infant_mortalities/update', 'SocialDevelopmentController@updateHealthInfantMortality');
Route::post('/social_development/health_infant_mortalities/delete', 'SocialDevelopmentController@deleteHealthInfantMortality');


Route::post('/social_development/dimensions_of_poverties/get', 'SocialDevelopmentController@getDimensionsOfPoverty');
Route::post('/social_development/dimensions_of_poverties/update', 'SocialDevelopmentController@updateDimensionsOfPoverty');

Route::post('/social_development/fire_preventions/get', 'SocialDevelopmentController@getFirePrevention');
Route::post('/social_development/fire_preventions/update', 'SocialDevelopmentController@updateFirePrevention');

Route::post('/social_development/social_welfare_services/get', 'SocialDevelopmentController@getSocialWelfareService');
Route::post('/social_development/social_welfare_services/update', 'SocialDevelopmentController@updateSocialWelfareService');






Route::post('/auth/info', 'UserController@getAuth');
// User link
Route::post('/user/create', 'UserController@create');
Route::post('/user/list', 'UserController@getUserList');

// USER ACCESS LIST
Route::post('/user/privilege/new', 'UserController@create_new_access');
Route::post('/user/privilege/get', 'UserController@get_all_access');
Route::post('/user/privilege/delete', 'UserController@delete_access');

// ADD USER PRIVILEGE
Route::post('/user/access/get', 'UserController@get_user_access');
Route::post('/user/access/add', 'UserController@add_user_access');
Route::post('/user/access/remove', 'UserController@remove_user_access');

Route::post('/user/change_password', 'UserController@changePassword');


Route::get('/mail', 'MailController@test_mail');


Route::get('/home', 'HomeController@index')->name('home');




// ADD USER PRIVILEGE
Route::post('/project/get', 'ProjectManagementController@get');
Route::post('/project/create', 'ProjectManagementController@create');
Route::post('/project/update', 'ProjectManagementController@update');
Route::post('/project/delete', 'ProjectManagementController@delete');
Route::post('/project/find', 'ProjectManagementController@find');
Route::post('/project/monitor/update', 'ProjectManagementController@updateMonitor');
Route::post('/project/monitoring_team', 'ProjectManagementController@getMonitoringList');
Route::post('/project/implementor_agency_lists/get', 'ProjectManagementController@getImplementorAgencyList');
Route::post('/project/update/link', 'ProjectManagementController@updateLink');


Route::post('/project/report/print', 'ProjectManagementController@print_report');
Route::post('/project/upload/attached_file', 'ProjectManagementController@uploadAttachedFiles');
Route::post('/project/get/attached_file', 'ProjectManagementController@getAttachedFile');
Route::post('/project/upload/remove_file', 'ProjectManagementController@removeFile');

Route::post('/project/get/getFundSourceYear', 'ProjectManagementController@getFundSourceYear');
Route::post('/project/get/getInfo', 'ProjectManagementController@getInfo');


Route::post('/general_information/insert', 'GeneralInformationController@insert');
Route::post('/general_information/update', 'GeneralInformationController@update');
Route::post('/general_information/getYear', 'GeneralInformationController@getYear');
Route::post('/general_information/remove', 'GeneralInformationController@remove');


// MUNICIPALITY

Route::post('/land_area_municipality/get', 'LandAndOtherNaturalResourcesController@getLandAreaByMunicipality');
Route::post('/land_area_municipality/update', 'LandAndOtherNaturalResourcesController@updateLandAreaMuniticipalty');


// Land Classification statistics
Route::post('/land_classification_statistics/get', 'LandAndOtherNaturalResourcesController@getLandClassificationStatistics');
Route::post('/land_classification_statistics/update', 'LandAndOtherNaturalResourcesController@updateLandClassificationStatistics');





Route::post('/geographical_zone_surface/get', 'LandAndOtherNaturalResourcesController@getGeographicalZoneSurfaces');

Route::post('/geographical_zone_surface/update', 'LandAndOtherNaturalResourcesController@updateGeographicalZoneSurfaces');

Route::post('/non_metallic_minerals/get', 'LandAndOtherNaturalResourcesController@getNonMetallicMineral');
Route::post('/non_metallic_minerals/update', 'LandAndOtherNaturalResourcesController@updateNonMetallicMineral');


Route::post('/major_watershed/get', 'LandAndOtherNaturalResourcesController@getMajorWatershed');
Route::post('/major_watershed/create', 'LandAndOtherNaturalResourcesController@createMajorWatershed');
Route::post('/major_watershed/update', 'LandAndOtherNaturalResourcesController@updateMajorWatershed');
Route::post('/major_watershed/delete', 'LandAndOtherNaturalResourcesController@deleteMajorWatershed');


Route::post('/coastal_resources/get', 'LandAndOtherNaturalResourcesController@getCoastalResource');
Route::post('/coastal_resources/update', 'LandAndOtherNaturalResourcesController@updateCoastalResource');


Route::post('/established_marine_protected_areas/get', 'LandAndOtherNaturalResourcesController@getEstablishedMarineProtectedArea');

Route::post('/established_marine_protected_areas/create', 'LandAndOtherNaturalResourcesController@createEstablishedMarineProtectedArea');

Route::post('/established_marine_protected_areas/update', 'LandAndOtherNaturalResourcesController@updateEstablishedMarineProtectedArea');
Route::post('/established_marine_protected_areas/delete', 'LandAndOtherNaturalResourcesController@deleteEstablishedMarineProtectedArea');


Route::post('/land_and_natural_resources/forest_covers/get', 'LandAndOtherNaturalResourcesController@getForestCover');
Route::post('/land_and_natural_resources/forest_covers/update', 'LandAndOtherNaturalResourcesController@updateForestCover');

Route::post('/land_and_natural_resources/metallic_mineral_resources/get', 'LandAndOtherNaturalResourcesController@getMetallicMineralResource');
Route::post('/land_and_natural_resources/metallic_mineral_resources/create', 'LandAndOtherNaturalResourcesController@createMetallicMineralResource');
Route::post('/land_and_natural_resources/metallic_mineral_resources/update', 'LandAndOtherNaturalResourcesController@updateMetallicMineralResource');
Route::post('/land_and_natural_resources/metallic_mineral_resources/delete', 'LandAndOtherNaturalResourcesController@deleteMetallicMineralResource');






Route::post('/municipality/watershed', 'MunicipalityController@watershed');
Route::post('/municipality/get', 'MunicipalityController@get');
Route::post('/municipality/getMunicipalityWithPSGC', 'MunicipalityController@getMunicipalityWithPSGC');
Route::post('/municipality/barangay', 'MunicipalityController@getBarangay');
Route::post('/municipality/getBarangayWithPSGC', 'MunicipalityController@getBarangayWithPSGC');







Route::post('/personnel/office/get', 'InstitutionalProfileController@getPersonnelByOffice');
Route::post('/personnel/office/update', 'InstitutionalProfileController@updatePersonnelByOffice');

Route::post('/personnel/status/get', 'InstitutionalProfileController@getPersonnelByStatus');
Route::post('/personnel/status/update', 'InstitutionalProfileController@updatePersonnelByStatus');


Route::post('/financial_profile/annual_budget/get', 'FinancialProfileController@getAnnualIncomeBudget');
Route::post('/financial_profile/annual_budget/update', 'FinancialProfileController@updateAnnualIncomeBudget');

Route::post('/financial_profile/income_and_expenditure/get', 'FinancialProfileController@getIncomeAndExpenditure');


Route::post('/financial_profile/income_and_expenditure/update', 'FinancialProfileController@updateIncomeAndExpenditure');

Route::post('/infrustructure_and_utilities/satellite_television_networks/get', 'InfrastructureUtilitiesController@getSatelliteTelevisionNetwork'); 
Route::post('/infrustructure_and_utilities/satellite_television_networks/create', 'InfrastructureUtilitiesController@createSatelliteTelevisionNetwork'); 
Route::post('/infrustructure_and_utilities/satellite_television_networks/update', 'InfrastructureUtilitiesController@updateSatelliteTelevisionNetwork'); 
Route::post('/infrustructure_and_utilities/satellite_television_networks/delete', 'InfrastructureUtilitiesController@deleteSatelliteTelevisionNetwork'); 

Route::post('/infrustructure_and_utilities/radio_stations/get', 'InfrastructureUtilitiesController@getRadioStation'); 
Route::post('/infrustructure_and_utilities/radio_stations/create', 'InfrastructureUtilitiesController@createRadioStation');
Route::post('/infrustructure_and_utilities/radio_stations/update', 'InfrastructureUtilitiesController@updateRadioStation');
Route::post('/infrustructure_and_utilities/radio_stations/delete', 'InfrastructureUtilitiesController@deleteRadioStation'); 


Route::post('/infrustructure_and_utilities/cable_television_networks/get', 'InfrastructureUtilitiesController@getCableTelevisionNetwork'); 
Route::post('/infrustructure_and_utilities/cable_television_networks/create', 'InfrastructureUtilitiesController@createCableTelevisionNetwork'); 
Route::post('/infrustructure_and_utilities/cable_television_networks/update', 'InfrastructureUtilitiesController@updateCableTelevisionNetwork'); 
Route::post('/infrustructure_and_utilities/cable_television_networks/delete', 'InfrastructureUtilitiesController@deleteCableTelevisionNetwork'); 

Route::post('/infrustructure_and_utilities/registered_vechicle/get', 'InfrastructureUtilitiesController@getRegisteredVehicle');
Route::post('/infrustructure_and_utilities/registered_vechicle/update', 'InfrastructureUtilitiesController@updateRegisteredVehicle');


Route::post('/infrustructure_and_utilities/communication/get', 'InfrastructureUtilitiesController@getCommunication');
Route::post('/infrustructure_and_utilities/communication/update', 'InfrastructureUtilitiesController@updateCommunication');



Route::post('/infrustructure_and_utilities/status_of_power/get', 'InfrastructureUtilitiesController@getStatusOfPower');
Route::post('/infrustructure_and_utilities/status_of_power/update', 'InfrastructureUtilitiesController@updateStatusOfPower');


Route::post('/infrustructure_and_utilities/energized_and_unenergized_barangay_sitios/get', 'InfrastructureUtilitiesController@getEnergizedUnergizedBarangay');
Route::post('/infrustructure_and_utilities/energized_and_unenergized_barangay_sitios/update', 'InfrastructureUtilitiesController@updateEnergizedUnergizedBarangay');


Route::post('/infrustructure_and_utilities/water_system/get', 'InfrastructureUtilitiesController@getWaterSystem');

Route::post('/infrustructure_and_utilities/water_system/create', 'InfrastructureUtilitiesController@createWaterSystem');
Route::post('/infrustructure_and_utilities/water_system/update', 'InfrastructureUtilitiesController@updateWaterSystem');

Route::post('/infrustructure_and_utilities/household_population_by_source_of_drinking_waters/get', 'InfrastructureUtilitiesController@getHouseholdPopulationBySourceOfDrinkingWater');
Route::post('/infrustructure_and_utilities/household_population_by_source_of_drinking_waters/create', 'InfrastructureUtilitiesController@createHouseholdPopulationBySourceOfDrinkingWater');
Route::post('/infrustructure_and_utilities/household_population_by_source_of_drinking_waters/update', 'InfrastructureUtilitiesController@updateHouseholdPopulationBySourceOfDrinkingWater');
Route::post('/infrustructure_and_utilities/household_population_by_source_of_drinking_waters/delete', 'InfrastructureUtilitiesController@deleteHouseholdPopulationBySourceOfDrinkingWater');


Route::post('/infrustructure_and_utilities/present_source_of_powers/get', 'InfrastructureUtilitiesController@getPresentSourceOfPower');
Route::post('/infrustructure_and_utilities/present_source_of_powers/create', 'InfrastructureUtilitiesController@createPresentSourceOfPower');
Route::post('/infrustructure_and_utilities/present_source_of_powers/update', 'InfrastructureUtilitiesController@updatePresentSourceOfPower');
Route::post('/infrustructure_and_utilities/present_source_of_powers/delete', 'InfrastructureUtilitiesController@deletePresentSourceOfPower');

Route::post('/infrustructure_and_utilities/power_substations/get', 'InfrastructureUtilitiesController@getPowerSubstation');
Route::post('/infrustructure_and_utilities/power_substations/create', 'InfrastructureUtilitiesController@createPowerSubstation');
Route::post('/infrustructure_and_utilities/power_substations/update', 'InfrastructureUtilitiesController@updatePowerSubstation');
Route::post('/infrustructure_and_utilities/power_substations/delete', 'InfrastructureUtilitiesController@deletePowerSubstation');


Route::post('/infrustructure_and_utilities/license_permit_issueds/get', 'InfrastructureUtilitiesController@getLicensePermitIssued');

Route::post('/infrustructure_and_utilities/license_permit_issueds/update', 'InfrastructureUtilitiesController@updateLicensePermitIssued');







// DEMOGRAPH
Route::post('/demograph/ancestral_domain/get', 'DemographController@getAncestralDomain');
Route::post('/demograph/ancestral_domain/create', 'DemographController@createAncestralDomain');
Route::post('/demograph/ancestral_domain/update', 'DemographController@updateAncestralDomain');
Route::post('/demograph/ancestral_domain/delete', 'DemographController@deleteAncestralDomain');

Route::post('/demograph/population_by_census_year/create', 'DemographController@createPopulationByCensusYear');
Route::post('/demograph/population_by_census_year/get', 'DemographController@getPopulationByCensusYear');
Route::post('/demograph/population_by_census_year/udate', 'DemographController@updatePopulationByCensusYear');

Route::post('/demograph/household_population_by_sexes/create', 'DemographController@createHouseholdPopulationBySex');
Route::post('/demograph/household_population_by_sexes/get', 'DemographController@getHouseholdPopulationBySex');
Route::post('/demograph/household_population_by_sexes/update', 'DemographController@updateHouseholdPopulationBySex');

Route::post('/demograph/mangyan_tribes/get', 'DemographController@getMangyanTribe');
Route::post('/demograph/mangyan_tribes/create', 'DemographController@createMangyanTribe');
Route::post('/demograph/mangyan_tribes/update', 'DemographController@updateMangyanTribe');
Route::post('/demograph/mangyan_tribes/delete', 'DemographController@deleteMangyanTribe');

Route::post('/demograph/actual_projecteds/get', 'DemographController@getActualProjected');
Route::post('/demograph/actual_projecteds/getYear', 'DemographController@getYearActualProjected');
Route::post('/demograph/actual_projecteds/create', 'DemographController@createActualProjected');
Route::post('/demograph/actual_projecteds/update', 'DemographController@updateActualProjected');

Route::post('/demograph/population_densities/get', 'DemographController@getPopulationDensity');
Route::post('/demograph/population_densities/getYear', 'DemographController@getYearPopulationDensity');
Route::post('/demograph/population_densities/create', 'DemographController@createPopulationDensity');
Route::post('/demograph/population_densities/update', 'DemographController@updatePopulationDensity');

Route::post('/demograph/projected_populations/get', 'DemographController@getProjectedPopulation');
Route::post('/demograph/projected_populations/create', 'DemographController@createProjectedPopulation');
Route::post('/demograph/projected_populations/update', 'DemographController@updateProjectedPopulation');

Route::post('/demograph/urban_rural_populations/get', 'DemographController@getUrbanRuralPopulation');
Route::post('/demograph/urban_rural_populations/getYear', 'DemographController@getYearUrbanRuralPopulation');
Route::post('/demograph/urban_rural_populations/create', 'DemographController@createUrbanRuralPopulation');
Route::post('/demograph/urban_rural_populations/update', 'DemographController@updateUrbanRuralPopulation');





// ECONOMIC PROFILE
Route::post('/economic_profile/rice_area_by_city/get', 'EconomicProfileController@getRiceAreaCity');
Route::post('/economic_profile/rice_area_by_city/update', 'EconomicProfileController@updateRiceAreaCity');

Route::post('/economic_profile/irrigated_area/get', 'EconomicProfileController@getIrrigatedArea');
Route::post('/economic_profile/irrigated_area/update', 'EconomicProfileController@updateIrrigatedArea');


Route::post('/economic_profile/rice_production/get', 'EconomicProfileController@getRiceProduction');
Route::post('/economic_profile/rice_production/update', 'EconomicProfileController@updateRiceProduction');

Route::post('/economic_profile/corn_production/get', 'EconomicProfileController@getCornProduction');
Route::post('/economic_profile/corn_production/update', 'EconomicProfileController@updateCornProduction');

Route::post('/economic_profile/vegetable_production/get', 'EconomicProfileController@getVegetableProduction');
Route::post('/economic_profile/vegetable_production/update', 'EconomicProfileController@updateVegetableProduction');


Route::post('/economic_profile/coconut_production/get', 'EconomicProfileController@getCoconutProduction');
Route::post('/economic_profile/coconut_production/update', 'EconomicProfileController@updateCoconutProduction');

Route::post('/economic_profile/accommodation_establishments/get', 'EconomicProfileController@getAccommodationEstablishment');
Route::post('/economic_profile/accommodation_establishments/update', 'EconomicProfileController@updateAccommodationEstablishment');

Route::post('/economic_profile/banks_and_atms/get', 'EconomicProfileController@getBanksAndAtm');
Route::post('/economic_profile/banks_and_atms/update', 'EconomicProfileController@updateBanksAndAtm');



Route::post('/economic_profile/high_value_commercial_crops/get', 'EconomicProfileController@getHighValueCommercialCrop');
Route::post('/economic_profile/high_value_commercial_crops/create', 'EconomicProfileController@createHighValueCommercialCrop');
Route::post('/economic_profile/high_value_commercial_crops/update', 'EconomicProfileController@updateHighValueCommercialCrop');
Route::post('/economic_profile/high_value_commercial_crops/delete', 'EconomicProfileController@deleteHighValueCommercialCrop');


Route::post('/economic_profile/tourist_sites_and_destinations/get', 'EconomicProfileController@getTouristSitesAndDestination');
Route::post('/economic_profile/tourist_sites_and_destinations/create', 'EconomicProfileController@createTouristSitesAndDestination');
Route::post('/economic_profile/tourist_sites_and_destinations/update', 'EconomicProfileController@updateTouristSitesAndDestination');
Route::post('/economic_profile/tourist_sites_and_destinations/delete', 'EconomicProfileController@deleteTouristSitesAndDestination');

// COMMERCE AND INDUSTRY
Route::post('/economic_profile/commerce_and_industry/get', 'EconomicProfileController@getCommerceAndIndustry');
Route::post('/economic_profile/commerce_and_industry/update', 'EconomicProfileController@updateCommerceAndIndustry');

Route::post('/economic_profile/top_five_products/get', 'EconomicProfileController@getTopFiveProduct');
Route::post('/economic_profile/top_five_products/create', 'EconomicProfileController@createTopFiveProduct');
Route::post('/economic_profile/top_five_products/update', 'EconomicProfileController@updateTopFiveProduct');
Route::post('/economic_profile/top_five_products/delete', 'EconomicProfileController@deleteTopFiveProduct');


Route::post('/economic_profile/top_five_fruit_areas/get', 'EconomicProfileController@getTopFiveFruitArea');
Route::post('/economic_profile/top_five_fruit_areas/create', 'EconomicProfileController@createTopFiveFruitArea');
Route::post('/economic_profile/top_five_fruit_areas/update', 'EconomicProfileController@updateTopFiveFruitArea');
Route::post('/economic_profile/top_five_fruit_areas/delete', 'EconomicProfileController@deleteTopFiveFruitArea');


// VUE ROUTE CATCHER
Route::get('/{vue_capture?}', function () { return view('welcome'); })->where('vue_capture', '[\/\w\.-]*')->middleware('auth');;
