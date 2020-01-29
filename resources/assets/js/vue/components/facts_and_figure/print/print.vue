<template>
	<div class="main" id="content">
		<div class="sidenav">
			<button class="btn btn-primary btn-toggle rounded-0" @click="toggleClass">
				 <font-awesome-icon :icon="['fas', 'bars']" />
			</button>
			<ul class="sidenav-list">
				<li><a href="#general_information">I. General Information</a></li>
				<li class="divider"></li>
				<li><span>II. Land Area by City/Muncipality</span></li>
				<li>
					<a href="#municipality">1. Land Area by City/Municipality</a>
				</li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="land_area_by_municipality">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li>
					<a href="#land_classification_statistic">2. Land Classification Statistics</a>
				</li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="land_classification_statistic">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>

				<li><a href="#geographical_zone_surface">3. Geographical Zone Surfaces</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="geographical_zone_surface">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>

				<li><a href="#forest_covers">4. Forest Cover</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="forest_cover">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#major_watershed">5 . Watersheds</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="major_watershed">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#marine_protected_areas">6. Coastal Resources (Marine Protected Areas)</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="marine_protected_areas">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>

				<li><a href="#established_marine_protected_areas">7. Established Marine Protected Areas</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="established_marine_protected_areas">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li class="divider"></li>
				<li>
					<span>III. Demograph</span>
				</li>
				<li><a href="#actual_projected_infos">1. Actual and Projected Population and Number of Households, Growth Rate by City/Municipality</a></li>
				<li>
					<div class="col-auto">

						<select class="form-control-sm" v-model="actual_projecteds">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in webyear_actual_projecteds" :value="item.actual_year">{{item.old_year}} - {{item.actual_year}}</option>
						</select> 
					</div>
				</li>


				<li><a href="#ancestral_domain">2. List of Ancestral Domain Applications and their status</a></li>
				<li>
					<div class="col-auto">

						<select class="form-control-sm" v-model="ancestral_domain">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select> 
					</div>
				</li>

				<li><a href="#household_population_by_sexes">3. House Hold Population by Sex</a></li>
				<li><a href="#mangyan_tribes">4. Mangyan Tribes</a></li>
				<li><a href="#population_by_census_year">5. Oriental Mindoro Population by City/Municipality, by Census Years</a></li>
				
				<li><a href="#population_density_infos">5. Population Density</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control" v-model="population_densities">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in webyear_population_densities" :value="item.actual_year">{{item.old_year}} - {{item.actual_year}}</option>
						</select>
					</div>
				</li>

				<li><a href="#projected_population_infos">6. Projected Population by Province, MIMAROPA</a></li>
				<li>
					<div class="col-auto">

						<select class="form-control-sm" v-model="projected_populations">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select> 
					</div>
				</li>

				

				<li><a href="#urban_rural_population_infos">7. Urban-Rural Population</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control" v-model="urban_rural_populations">
								<option value="" disabled selected>-- Select Year --</option>
								<option v-for="item in webyear_urban_rural_populations" :value="item.year_of_encoding">{{item.population_year_1}} - {{item.population_year_2}}</option>
							</select>
					</div>
				</li>
							
				<li class="divider"></li>
				<li>
					<span>IV. Economic Profile</span>
				</li>
				<li><span>a. Agriculture</span></li>
				<li><a href="#rice_area_city">1. Rice Area by City/Municipality</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="rice_area_city">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#irrigated_area">2. Irrigated Area by Type of Irrigation Facility by City/Municipality</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="irrigated_area">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>


				<li><a href="#corn_production">3. Corn Production by City/Municipality</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="corn_production">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#vegetable_production">4. Vegetable Production</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="vegetable_production">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>

				<li><a href="#high_value_commercial_crops">5. High Value Crops</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="high_value_commercial_crops">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				
				<li><a href="#top_five_products">6. Top 5 fruit production</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="top_five_products">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>

				<li><a href="#top_five_fruit_areas">7. Top 5 fruit area</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="top_five_products">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><span>b. Tourism</span></li>
				<li><a href="#accommodation_establishments">1. Oriental Mindoro Accomodation Establishments</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="accommodation_establishments">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><span>2. Tourist Sites and Destinations by City/Municipality</span></li>
				<li><span>c. Commerce and Industry</span></li>
				<li><a href="#commerce_and_industry">1. Business Establishments by Type, Investments & Employement</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="commerce_and_industry">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>


				<li><a href="#banks_and_atms">2. Number of banks and ATMs by City/Municipality</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="banks_and_atms">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>

				<li><span>V. Infrastructure and Utilities</span></li>
				<li><span>a. Transportation</span></li>

				<li><a href="#registered_vehicle">1. Registered Motor Vehicles</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="registered_vechicle">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#license_permit_issueds">2. License/Permit issued</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="license_permit_issueds">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><span>b. Communication</span></li>
				<li><a href="#communication">1. No. of Cellsites</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="communication">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><span>c. Water</span></li>

				<li><a href="#water_system">1. Level III Water System by City/Municipality</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="household_population_by_source_of_drinking_waters">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>

				<li><a href="#household_population_by_source_of_drinking_waters">2. Household Popultaion by Sourcfe of Drinking Water</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="household_population_by_source_of_drinking_waters">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><span>d. Power</span></li>
				<li><a href="#status_of_power">1. Status of Electrification</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="status_of_power">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#energized_and_unenergized_barangay_sitios">2. Energized and Unenergized Barangay and Sitios in Oriental Mindoro</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="energized_and_unenergized_barangay_sitios">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#present_source_of_powers">3. Present source of power</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="present_source_of_powers">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#power_substations">4. Power Substation</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="power_substations">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>

				<li><span>VI. Social Development Profile</span></li>
				<li><span>a. Labor and Employment</span></li>
				<li><span>b. Health</span></li>
				<li><a href="#health_morbidities">2. Morbidity: Leading Causes, Number and Rate per 100,000 Population Comparative Five Year Average</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="health_morbidities">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#health_infant_morbidities">3. Infant Morbidity: Leading Causes, Number and Rate per 100,000 Population Comparative Five Year Average</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="health_infant_morbidities">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#health_mortalities">4. Mortality: Leading Causes, Number and Rate per 100,000 Population Comparative Five Year Average</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="health_mortalities">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#health_infant_mortalities">5. Infant Mortality: Leading Causes, Number and Rate per 100,000 Population Comparative Five Year Average</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="health_infant_mortalities">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#nutritional_status">6. Nutritional Status</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="nutritional_status">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#health_facilities">7. Health Facilities</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="health_facilities">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>

				<li><a href="#doh_licensed_health_facilities">8. DOH-Licensed Health Facilities</a></li>
				<li><span>c. Education</span></li>

				<li><a href="#education_facilities">1. Education Facilities</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="education_facilities">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#enrollment_in_government_and_private_schools">2. Enrollment in Government and Private Schools by Level of Education</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="enrollment_in_government_and_private_schools">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#performance_indicator_in_public_schools">3. Performance Indicators in Public Elementary and Secondary Schools</a></li>
				<li>
					<div class="col-auto">
							<select class="form-control-sm" v-model="performance_indicator_in_public_schools">
								<option value="" disabled selected>-- Select Year --</option>
								<option v-for="item in defaultYear" :value="item">{{item}}</option>
							</select>
						</div>
				</li>

				<li><a href="#social_welfare_services">d. Social Welfare Services</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="social_welfare_services">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><span>e. Education</span></li>

				<li><a href="#crime_statistics_and_protective_facilities">1. Crime Statistics and Protective Facilities</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="crime_statistics_and_protective_facilities">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#fire_preventions">2. Fire Prevention</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="fire_preventions">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><span>VII. Financial Profile</span></li>
				<li><a href="#annual_income_budget">1. Annual Income and Budget per City/Municipality</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="annual_income_budget">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#income_and_expenditures">2. Income and Expenditures</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="income_and_expenditure">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><span>VIII. Institutional Profile</span></li>
				<li><a href="#personnel_by_status">1. Personnel by Status</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="personnel_by_status">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
				<li><a href="#personnel_by_office">2. Personnel by Office</a></li>
				<li>
					<div class="col-auto">
						<select class="form-control-sm" v-model="personnel_by_office">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
					</div>
				</li>
			</ul>
		</div>
		<div class="article pt-5">
			<div class="container">
				<general_information :year="general_information" class="mt-5"></general_information>
				<land_area_by_municipality :year="land_area_by_municipality" class="mt-5"></land_area_by_municipality>
				<land_classification_statistic :year="land_classification_statistic" class="mt-5"></land_classification_statistic>
				<geographical_zone_surface :year="geographical_zone_surface" class="mt-5"></geographical_zone_surface> 
				<forest_cover :year="forest_cover" class="mt-5"></forest_cover> 
				<major_watershed :year="forest_cover" class="mt-5"></major_watershed> 
				<marine_protected_areas :year="marine_protected_areas" class="mt-5"></marine_protected_areas> 
				<established_marine_protected_areas :year="established_marine_protected_areas" class="mt-5"></established_marine_protected_areas> 


				<!-- DEMOGRAPH -->
				<actual_projecteds :year="actual_projecteds"></actual_projecteds>
				<ancestral_domain :year="ancestral_domain"></ancestral_domain>
				<household_population_by_sexes :year="household_population_by_sexes"></household_population_by_sexes>
				<mangyan_tribes :year="mangyan_tribes"></mangyan_tribes>
				<population_by_census_year :year="population_by_census_year"></population_by_census_year>
				<population_densities :year="population_densities"></population_densities>
				<projected_populations :year="projected_populations"></projected_populations>
				<urban_rural_populations :year="urban_rural_populations"></urban_rural_populations>


				<rice_area_city :year="rice_area_city" class="mt-5"></rice_area_city> 
				<irrigated_area :year="irrigated_area" class="mt-5"></irrigated_area> 
				<corn_production :year="corn_production" class="mt-5"></corn_production> 
				<vegetable_production :year="vegetable_production" class="mt-5"></vegetable_production> 
				<high_value_commercial_crops :year="high_value_commercial_crops" class="mt-5"></high_value_commercial_crops> 
				<accommodation_establishments :year="accommodation_establishments" class="mt-5"></accommodation_establishments> 
				<commerce_and_industry :year="commerce_and_industry" class="mt-5"></commerce_and_industry> 
				<top_five_products :year="top_five_products" class="mt-5"></top_five_products> 
				<top_five_fruit_areas :year="top_five_fruit_areas" class="mt-5"></top_five_fruit_areas> 
				<banks_and_atms :year="banks_and_atms" class="mt-5"></banks_and_atms> 
				<registered_vechicle :year="registered_vechicle" class="mt-5"></registered_vechicle> 
				<license_permit_issueds :year="license_permit_issueds" class="mt-5"></license_permit_issueds> 
				<communication :year="communication" class="mt-5"></communication> 
				<water_system :year="water_system" class="mt-5"></water_system> 
				<household_population_by_source_of_drinking_waters :year="household_population_by_source_of_drinking_waters" class="mt-5"></household_population_by_source_of_drinking_waters> 
				<status_of_power :year="status_of_power" class="mt-5"></status_of_power> 
				<energized_and_unenergized_barangay_sitios :year="energized_and_unenergized_barangay_sitios" class="mt-5"></energized_and_unenergized_barangay_sitios> 
				<present_source_of_powers :year="present_source_of_powers" class="mt-5"></present_source_of_powers> 
				<power_substations :year="power_substations" class="mt-5"></power_substations>  
				<!-- SOCIAL DEVELOPMENT -->
				<!-- <dimensions_of_poverties :year="dimensions_of_poverties" class="mt-5"></dimensions_of_poverties> -->
				<health_morbidities :year="health_morbidities" class="mt-5"></health_morbidities>
				<health_infant_morbidities :year="health_infant_morbidities" class="mt-5"></health_infant_morbidities>
				<health_mortalities :year="health_mortalities" class="mt-5"></health_mortalities>
				<health_infant_mortalities :year="health_infant_mortalities" class="mt-5"></health_infant_mortalities>
				<nutritional_status :year="nutritional_status" class="mt-5"></nutritional_status>
				<health_facilities :year="health_facilities" class="mt-5"></health_facilities>
				<doh_licensed_health_facilities :year="doh_licensed_health_facilities" class="mt-5"></doh_licensed_health_facilities>
				<education_facilities :year="education_facilities" class="mt-5"></education_facilities> 
				<enrollment_in_government_and_private_schools :year="enrollment_in_government_and_private_schools" class="mt-5"></enrollment_in_government_and_private_schools>
				<performance_indicator_in_public_schools :year="performance_indicator_in_public_schools" class="mt-5"></performance_indicator_in_public_schools>
				<social_welfare_services :year="social_welfare_services" class="mt-5"></social_welfare_services>
				<senior_citizen_and_person_with_disabilities :year="social_welfare_services" class="mt-5"></senior_citizen_and_person_with_disabilities>
				<crime_statistics_and_protective_facilities :year="crime_statistics_and_protective_facilities" class="mt-5"></crime_statistics_and_protective_facilities>
				<fire_preventions :year="fire_preventions" class="mt-5"></fire_preventions>
				<!-- SOCIAL DEVELOPMENT -->
				<annual_income_budget :year="annual_income_budget" class="mt-5"></annual_income_budget> 
				<income_and_expenditure :year="income_and_expenditure" class="mt-5"></income_and_expenditure>
				<personnel_by_status :year="personnel_by_status" class="mt-5"></personnel_by_status>
				<personnel_by_office :year="personnel_by_office" class="mt-5"></personnel_by_office>  
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
				actual_projecteds: "",
				ancestral_domain: "",
				household_population_by_sexes: "",
				mangyan_tribes: "",
				population_by_census_year: "",
				population_densities: "",
				projected_populations: "",
				urban_rural_populations: "",


				webyear_actual_projecteds: [],
				webyear_population_densities: [],
				webyear_urban_rural_populations: [],


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
			},
			toggleClass: function(){
				$('#content').toggleClass('toggle');
			},
			getYear: function(){
				var vm = this;
				axios.post('/demograph/actual_projecteds/getYear')
						.then(data => {
							vm.webyear_actual_projecteds = data.data;
						})

				axios.post('/demograph/population_densities/getYear')
					.then(data => {
						vm.webyear_population_densities = data.data;
					})

				axios.post('/demograph/urban_rural_populations/getYear')
						.then(data => {
							vm.webyear_urban_rural_populations = data.data;
						})
			}
		},
		mounted:function(){
			this.getYear();
			this.csrf_token = $('meta[name="csrf-token"]').attr('content')
		}
	}
</script>