<style>
	.table-auto{
		width: auto !important;
	}
</style>
<template>
	<div id="print">
		<div class="row">
			<div class="card-body">
				<div class="card">
					<div class="card-body">
								<div class="row justify-content-between">
							<div class="col-auto">
								I. General Information
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								II. Land Area by City/Muncipality
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;1. Land Area by City/Municipality
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="land_area_by_municipality">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;2. Land Classification Statistics
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="land_classification_statistic">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;3. Geographical Zone Surfaces
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="geographical_zone_surface">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;4. Forest Cover
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="forest_cover">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;5 . Watersheds
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="major_watershed">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;6. Coastal Resources (Marine Protected Areas)
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="marine_protected_areas">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;7. Established Marine Protected Areas
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="established_marine_protected_areas">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								IV. Economic Profile
							</div>
						</div>


						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;a. Agriculture
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;1. Rice Area by City/Municipality
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="rice_area_city">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;2. Irrigated Area by Type of Irrigation Facility by City/Municipality
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="irrigated_area">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;3. Corn Production by City/Municipality
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="corn_production">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;4. Vegetable Production
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="vegetable_production">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;5. High Value Crops
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="high_value_commercial_crops">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;6. Top 5 fruit production
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="top_five_products">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;7. Top 5 fruit area
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="top_five_products">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;b. Tourism
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;1. Oriental Mindoro Accomodation Establishments
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="accommodation_establishments">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;2. Tourist Sites and Destinations by City/Municipality
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;c. Commerce and Industry
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;1. Business Establishments by Type, Investments & Employement
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="commerce_and_industry">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;2. Number of banks and ATMs by City/Municipality
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="banks_and_atms">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								V. Infrastructure and Utilities
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;a. Transportation
							</div>
						</div>


						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;1. Registered Motor Vehicles
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="registered_vechicle">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;2. License/Permit issued
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="license_permit_issueds">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>


						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;b. Communication
							</div>
						</div>


						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;1. No. of Cellsites
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="communication">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>


						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;c. Water
							</div>
						</div>


						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;1. Level III Water System by City/Municipality
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="water_system">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;2. Household Popultaion by Sourcfe of Drinking Water
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="household_population_by_source_of_drinking_waters">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;d. Power
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;1. Status of Electrification
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="status_of_power">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;2. Energized and Unenergized Barangay and Sitios in Oriental Mindoro
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="energized_and_unenergized_barangay_sitios">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;3. Present source of power
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="present_source_of_powers">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;4. Power Substation
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="power_substations">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								VI. Social Development Profile
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;a. Labor and Employment
							</div>
						</div>
					<!-- 	<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;1. The 13+ Dimenstions of Poverty, Oriental Mindoro
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="dimensions_of_poverties">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div> -->

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;b. Health
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;2. Morbidity: Leading Causes, Number and Rate per 100,000 Population Comparative Five Year Average
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="health_morbidities">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;3. Infant Morbidity: Leading Causes, Number and Rate per 100,000 Population Comparative Five Year Average
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="health_infant_morbidities">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;4. Mortality: Leading Causes, Number and Rate per 100,000 Population Comparative Five Year Average
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="health_mortalities">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;5. Infant Mortality: Leading Causes, Number and Rate per 100,000 Population Comparative Five Year Average
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="health_infant_mortalities">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;6. Nutritional Status
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="nutritional_status">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;7. Health Facilities
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="health_facilities">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;8. DOH-Licensed Health Facilities
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;c. Education
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;1. Education Facilities
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="education_facilities">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;2. Enrollment in Government and Private Schools by Level of Education
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="enrollment_in_government_and_private_schools">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;3. Performance Indicators in Public Elementary and Secondary Schools
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="performance_indicator_in_public_schools">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
									&nbsp;&nbsp;d. Social Welfare Services
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="social_welfare_services">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;e. Education
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
									&nbsp;&nbsp;&nbsp;&nbsp;1. Crime Statistics and Protective Facilities
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="crime_statistics_and_protective_facilities">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
									&nbsp;&nbsp;&nbsp;&nbsp;2. Fire Prevention
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="fire_preventions">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>

						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								VII. Financial Profile
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;1. Annual Income and Budget per City/Municipality
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="annual_income_budget">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;2. Income and Expenditures
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="income_and_expenditure">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								VIII. Institutional Profile
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;1. Personnel by Status
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="personnel_by_status">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
						<div class="row justify-content-between mt-1">
							<div class="col-auto">
								&nbsp;&nbsp;&nbsp;&nbsp;2. Personnel by Office
							</div>
							<div class="col-auto">
								<select class="form-control-sm" v-model="personnel_by_office">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-1">
			<div class="col-md">
				<div class="card">
					<div class="card-body">
						<form ref="forms" method="post" action="/generate_word">
							<input type="hidden" name="_token" v-model="csrf_token">
							<textarea type="text" hidden name="codes" v-model="htmls_code"></textarea>
							<button class="btn btn-secondary" @click="submitCode" type="button" v-if="htmls_code == ''">Copy</button>
							<button class="btn btn-dark"  type="submit" v-if="htmls_code != ''" @click="htmls_code = ''">Print</button>
						</form>
						<div id="htmls_code">
								<general_information :year="general_information"></general_information>
								<land_area_by_municipality :year="land_area_by_municipality"></land_area_by_municipality>
								<land_classification_statistic :year="land_classification_statistic"></land_classification_statistic>
								<geographical_zone_surface :year="geographical_zone_surface"></geographical_zone_surface> 
								<forest_cover :year="forest_cover"></forest_cover> 
								<major_watershed :year="forest_cover"></major_watershed> 
								<marine_protected_areas :year="marine_protected_areas"></marine_protected_areas> 
								<established_marine_protected_areas :year="established_marine_protected_areas"></established_marine_protected_areas> 
								<rice_area_city :year="rice_area_city"></rice_area_city> 
								<irrigated_area :year="irrigated_area"></irrigated_area> 
								<corn_production :year="corn_production"></corn_production> 
								<vegetable_production :year="vegetable_production"></vegetable_production> 
								<high_value_commercial_crops :year="high_value_commercial_crops"></high_value_commercial_crops> 
								<accommodation_establishments :year="accommodation_establishments"></accommodation_establishments> 
								<commerce_and_industry :year="commerce_and_industry"></commerce_and_industry> 
								<top_five_products :year="top_five_products"></top_five_products> 
								<top_five_fruit_areas :year="top_five_fruit_areas"></top_five_fruit_areas> 
								<banks_and_atms :year="banks_and_atms"></banks_and_atms> 
								<registered_vechicle :year="registered_vechicle"></registered_vechicle> 
								<license_permit_issueds :year="license_permit_issueds"></license_permit_issueds> 
								<communication :year="communication"></communication> 
								<water_system :year="water_system"></water_system> 
								<household_population_by_source_of_drinking_waters :year="household_population_by_source_of_drinking_waters"></household_population_by_source_of_drinking_waters> 
								<status_of_power :year="status_of_power"></status_of_power> 
								<energized_and_unenergized_barangay_sitios :year="energized_and_unenergized_barangay_sitios"></energized_and_unenergized_barangay_sitios> 
								<present_source_of_powers :year="present_source_of_powers"></present_source_of_powers> 
								<power_substations :year="power_substations"></power_substations>  
								<!-- SOCIAL DEVELOPMENT -->
								<!-- <dimensions_of_poverties :year="dimensions_of_poverties"></dimensions_of_poverties> -->
								<health_morbidities :year="health_morbidities"></health_morbidities>
								<health_infant_morbidities :year="health_infant_morbidities"></health_infant_morbidities>
								<health_mortalities :year="health_mortalities"></health_mortalities>
								<health_infant_mortalities :year="health_infant_mortalities"></health_infant_mortalities>
								<nutritional_status :year="nutritional_status"></nutritional_status>
								<health_facilities :year="health_facilities"></health_facilities>
								<doh_licensed_health_facilities :year="doh_licensed_health_facilities"></doh_licensed_health_facilities>
								<education_facilities :year="education_facilities"></education_facilities> 
								<enrollment_in_government_and_private_schools :year="enrollment_in_government_and_private_schools"></enrollment_in_government_and_private_schools>
								<performance_indicator_in_public_schools :year="performance_indicator_in_public_schools"></performance_indicator_in_public_schools>
								<social_welfare_services :year="social_welfare_services"></social_welfare_services>
								<senior_citizen_and_person_with_disabilities :year="social_welfare_services"></senior_citizen_and_person_with_disabilities>
								<crime_statistics_and_protective_facilities :year="crime_statistics_and_protective_facilities"></crime_statistics_and_protective_facilities>
								<fire_preventions :year="fire_preventions"></fire_preventions>
								<!-- SOCIAL DEVELOPMENT -->
								<annual_income_budget :year="annual_income_budget"></annual_income_budget> 
								<income_and_expenditure :year="income_and_expenditure"></income_and_expenditure>
								<personnel_by_status :year="personnel_by_status"></personnel_by_status>
								<personnel_by_office :year="personnel_by_office"></personnel_by_office>  
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data: function(){
			return {
				general_information: "",
				land_area_by_municipality: "",
				land_classification_statistic: "",
				geographical_zone_surface: "",
				forest_cover: "",
				major_watershed: "",
				marine_protected_areas: "",
				established_marine_protected_areas: "",
				rice_area_city: "",
				irrigated_area: "",
				corn_production: "",
				vegetable_production: "",
				high_value_commercial_crops: "",
				accommodation_establishments: "",
				tourist_sites_and_destinations: "",
				commerce_and_industry: "",
				top_five_products: "",
				top_five_fruit_areas: "",
				banks_and_atms: "",
				registered_vechicle: "",
				license_permit_issueds: "",
				communication: "",
				water_system: "",
				household_population_by_source_of_drinking_waters: "",
				status_of_power: "",
				energized_and_unenergized_barangay_sitios: "",
				present_source_of_powers: "",
				power_substations: "",
				annual_income_budget: "",
				income_and_expenditure: "",
				personnel_by_status: "",
				personnel_by_office: "",
				dimensions_of_poverties: "",
				health_morbidities: "",
				health_infant_morbidities: "",
				health_mortalities: "",
				health_infant_mortalities: "",
				nutritional_status: "",
				health_facilities: "",
				doh_licensed_health_facilities: "",
				education_facilities: "",
				enrollment_in_government_and_private_schools: "",
				performance_indicator_in_public_schools: "",
				social_welfare_services: "",
				crime_statistics_and_protective_facilities: "",
				fire_preventions: "",
				htmls_code: "",
				csrf_token: "",
			}
		},
		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		methods: {
			submitCode: function(){
				this.htmls_code = $('#htmls_code').html();
				// console.log(this.htmls_code);
				// this.$refs.forms.submit();
			}
		},
		mounted:function(){
			this.csrf_token = $('meta[name="csrf-token"]').attr('content')
		}
	}
</script>