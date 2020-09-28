import Vue from 'vue'
import VueRouter from 'vue-router'
// 
import USER from '../view/user/index.vue';
import USER_NEW from '../view/user/new.vue';
import USER_LIST from '../view/user/list.vue';
import USER_ACCESS_LIST from '../view/user/user_access_list.vue';
import USER_PASSWORD_CHANGE from '../view/user/change_password.vue';


import GENERAL_INFORMATION from '../view/general_information/index.vue';
import GENERAL_INFORMATION_ENCODING from '../view/general_information/encoding.vue';

import PROJECT_MANAGEMENT from '../view/project_management/index.vue';
import PROJECT_MANAGEMENT_LIST from '../view/project_management/list.vue';
import PROJECT_MANAGEMENT_ENCODING from '../view/project_management/encoding.vue';
import PROJECT_MANAGEMENT_PRINT from '../view/project_management/print.vue';

import FACTS_AND_FIGURE from '../view/facts_and_figure/index.vue';

import LAND_AND_OTHER_NATURAL_RESOURCES from '../view/land_and_other_natural_resources/index.vue';
import LAND_AND_OTHER_NATURAL_RESOURCES_MUNICIPALITIES from '../view/land_and_other_natural_resources/land_area_municipality.vue';
import LAND_AND_OTHER_NATURAL_RESOURCES_LAND_CLASSIFICATION_STATISTICS from '../view/land_and_other_natural_resources/land_classification_statistic.vue';
import LAND_AND_OTHER_NATURAL_RESOURCES_GEOGRAPHICAL_ZONE_SURFACES from '../view/land_and_other_natural_resources/geographical_zone_surfaces.vue';
import LAND_AND_OTHER_NATURAL_RESOURCES_NON_METALLIC_MINERALS from '../view/land_and_other_natural_resources/non_metalic_minerals.vue';
import LAND_AND_OTHER_NATURAL_RESOURCES_MAJOR_WATERSHEDS from '../view/land_and_other_natural_resources/major_watershed.vue';
import LAND_AND_OTHER_NATURAL_RESOURCES_MARINE_PROTECTED_AREAS from '../view/land_and_other_natural_resources/marine_protected_areas.vue';
import LAND_AND_OTHER_NATURAL_RESOURCES_ESTABLISHED_MARINE_PROTECTED_AREAS from '../view/land_and_other_natural_resources/established_marine_protected_areas.vue';
import LAND_AND_OTHER_NATURAL_RESOURCES_FOREST_COVERS from '../view/land_and_other_natural_resources/forest_cover.vue';
import LAND_AND_OTHER_NATURAL_RESOURCES_METALLIC_MINERAL_RESOURCES from '../view/land_and_other_natural_resources/metallic_mineral_resources.vue';

// Institutional profile
import INSTITUTIONAL_PROFILE from '../view/institutional_profile/index.vue';
import INSTITUTIONAL_PROFILE_PERSONNEL from '../view/institutional_profile/personnel_by_office.vue';
import INSTITUTIONAL_PROFILE_PERSONNEL_BY_STATUS from '../view/institutional_profile/personnel_by_status.vue';

import FINANCIAL_PROFILE from '../view/financial_profile/index.vue';
import FINANCIAL_PROFILE_ANNUAL_INCOME from '../view/financial_profile/annual_income_budget.vue';
import FINANCIAL_PROFILE_INCOME_AND_EXPENDITURE from '../view/financial_profile/income_and_expenditures.vue';


import INFRASTRUCTURE_AND_UTILITIES from '../view/utilities_and_infrustructure/index.vue';
import INFRASTRUCTURE_AND_UTILITIES_REGISTERED_VIHICLE from '../view/utilities_and_infrustructure/registered_vehicle.vue';
import INFRASTRUCTURE_AND_UTILITIES_WATER_SYSTEM from '../view/utilities_and_infrustructure/water_system.vue';
import INFRASTRUCTURE_AND_UTILITIES_COMMUNICATION from '../view/utilities_and_infrustructure/communication.vue';
import INFRASTRUCTURE_AND_UTILITIES_STATUS_OF_POWER from '../view/utilities_and_infrustructure/status_of_power.vue';
import INFRASTRUCTURE_AND_UTILITIES_ENERGIZED_AND_UNENERGIZED_BARANGAY from '../view/utilities_and_infrustructure/energized_and_unenergized_barangay_sitios.vue';
import INFRASTRUCTURE_AND_UTILITIES_HOUSEHOLD_POPULATION_BY_SOURCE_OF_DRINKING_WATERS from '../view/utilities_and_infrustructure/household_population_by_source_of_drinking_waters.vue';
import INFRASTRUCTURE_AND_UTILITIES_PRESENT_SOURCE_OF_POWERS from '../view/utilities_and_infrustructure/present_source_of_powers.vue';
import INFRASTRUCTURE_AND_UTILITIES_POWER_SUBSTATIONS from '../view/utilities_and_infrustructure/power_substations.vue';
import INFRASTRUCTURE_AND_UTILITIES_LIST_OF_RATIO_STATIONS_AND_CABLE_TV_NETWORKS from '../view/utilities_and_infrustructure/list_of_ratio_stations_and_cable_tv_networks.vue';
import INFRASTRUCTURE_AND_UTILITIES_LICENSE_PERMIT_ISSUEDS from '../view/utilities_and_infrustructure/license_permit_issueds.vue';



import DEMOGRAPH from '../view/demograph/index.vue';
import DEMOGRAPH_ANCESTRAL_DOMAIN from '../view/demograph/ancestral_domain.vue';
import DEMOGRAPH_POPULATION_BY_CENSUS_YEAR from '../view/demograph/population_by_census_year.vue';
import DEMOGRAPH_HOUSEHOLD_POPULATION_BY_SEXES from '../view/demograph/household_population_by_sexes.vue';
import DEMOGRAPH_MANGYAN_TRIBES from '../view/demograph/mangyan_tribes.vue';
import DEMOGRAPH_ACTUAL_PROJECTEDS from '../view/demograph/actual_projecteds.vue';
import DEMOGRAPH_POPULATION_DENSITIES from '../view/demograph/population_densities.vue';
import DEMOGRAPH_PROJECTED_POPULATIONS from '../view/demograph/projected_populations.vue';
import DEMOGRAPH_URBAN_RURAL_POPULATIONS from '../view/demograph/urban_rural_populations.vue';

      
import ECONOMIC_PROFILE from '../view/economic_profile/index.vue';
import ECONOMIC_PROFILE_RICE_AREA_CITY from '../view/economic_profile/rice_area_city.vue';
import ECONOMIC_PROFILE_IRRIGATED_AREA from '../view/economic_profile/irrigated_area.vue';
import ECONOMIC_PROFILE_RICE_PRODUCTION from '../view/economic_profile/rice_production.vue';
import ECONOMIC_PROFILE_CORN_PRODUCTION from '../view/economic_profile/corn_production.vue';
import ECONOMIC_PROFILE_VEGETABLE_PRODUCTION from '../view/economic_profile/vegetable_production.vue';
import ECONOMIC_PROFILE_COCONUT_PRODUCTION from '../view/economic_profile/coconut_production.vue';
import ECONOMIC_PROFILE_HIGH_VALUE_COMMERCIAL_CROPS from '../view/economic_profile/high_value_commercial_crops.vue';
import ECONOMIC_PROFILE_ACCOMODATION_ESTABLISHMENT from '../view/economic_profile/accommodation_establishments.vue';
import ECONOMIC_PROFILE_TOURIST_SITES_AND_DESTINATION from '../view/economic_profile/tourist_sites_and_destinations.vue';
import ECONOMIC_PROFILE_NUMBER_OF_BANKS_AND_ATM from '../view/economic_profile/number_of_banks_and_atm.vue';
import ECONOMIC_PROFILE_COMMERCE_AND_INDUSTRY from '../view/economic_profile/commerce_and_industry.vue';
import ECONOMIC_PROFILE_TOP_FIVE_PRODUCT from '../view/economic_profile/top_five_product.vue';
import ECONOMIC_PROFILE_TOP_FIVE_FRUIT_AREAS from '../view/economic_profile/top_five_fruit_areas.vue';




import SOCIAL_DEVELOPMENT_PROFILE from '../view/social_development_profile/index.vue';
import SOCIAL_DEVELOPMENT_PROFILE_COMPARATIVE_LABOR_FORCE_PARTICIPATION from '../view/social_development_profile/comparative_labor_force_participation.vue';
import SOCIAL_DEVELOPMENT_PROFILE_COMPARATIVE_EMPLOYMENT_STATUSES from '../view/social_development_profile/comparative_employment_statuses.vue';
import SOCIAL_DEVELOPMENT_PROFILE_POVERTY_INCIDENCES from '../view/social_development_profile/poverty_incidences.vue';
import SOCIAL_DEVELOPMENT_PROFILE_NUMBER_RATE_BDIMDS from '../view/social_development_profile/number_rate_bdimds.vue';
import SOCIAL_DEVELOPMENT_PROFILE_DOH_LICENSED_HEALTH_FACILITIES from '../view/social_development_profile/doh_licensed_health_facilities.vue';
import SOCIAL_DEVELOPMENT_PROFILE_NUTRITIONAL_STATUS from '../view/social_development_profile/nutritional_status.vue';
import SOCIAL_DEVELOPMENT_PROFILE_HEALTH_FACILITIES from '../view/social_development_profile/health_facilities.vue';
import SOCIAL_DEVELOPMENT_PROFILE_SENIOR_CITIZEN_AND_PERSON_WITH_DISABILITIES from '../view/social_development_profile/senior_citizen_and_person_with_disabilities.vue';
import SOCIAL_DEVELOPMENT_PROFILE_CRIME_STATISTICS_AND_PROTECTIVE_FACILITIES from '../view/social_development_profile/crime_statistics_and_protective_facilities.vue';
import SOCIAL_DEVELOPMENT_PROFILE_EDUCATION_FACILITIES from '../view/social_development_profile/education_facilities.vue';
import SOCIAL_DEVELOPMENT_PROFILE_ENROLLMENT_IN_GOVERNMENT_AND_PRIVATE_SCHOOLS from '../view/social_development_profile/enrollment_in_government_and_private_schools.vue';
import SOCIAL_DEVELOPMENT_PROFILE_PERFORMANCE_INDICATOR_IN_PUBLIC_SCHOOLS from '../view/social_development_profile/performance_indicator_in_public_schools.vue';
import SOCIAL_DEVELOPMENT_PROFILE_HEALTH_MORBIDITIES from '../view/social_development_profile/health_morbidities.vue';

import SOCIAL_DEVELOPMENT_PROFILE_HEALTH_INFANT_MORBIDITIES from '../view/social_development_profile/health_infant_morbidities.vue';
import SOCIAL_DEVELOPMENT_PROFILE_HEALTH_MORTALITIES from '../view/social_development_profile/health_mortalities.vue';
import SOCIAL_DEVELOPMENT_PROFILE_HEALTH_INFANT_MORTALITIES from '../view/social_development_profile/health_infant_mortalities.vue';
import SOCIAL_DEVELOPMENT_PROFILE_DIMENSIONS_OF_POVERTIES from '../view/social_development_profile/dimensions_of_poverties.vue';
import SOCIAL_DEVELOPMENT_PROFILE_FIRE_PREVENTIONS from '../view/social_development_profile/fire_preventions.vue';
import SOCIAL_DEVELOPMENT_PROFILE_SOCIAL_WELFARE_SERVICES from '../view/social_development_profile/social_welfare_services.vue';

import PRINT from '../view/print/index.vue';


Vue.use(VueRouter);
const router = new VueRouter({
	mode:"history",
	history: true,
	hashbag:false,
	routes: [
      { path: '', component: PRINT },
      { path: '/user_management', component: USER,
        children:[
          {path: '', component: USER_LIST},
          {path: 'create', component: USER_NEW, name: 'user_create'},
          {path: 'list', component: USER_LIST, name: 'user_list'},
          {path: 'user_access_list', component: USER_ACCESS_LIST, name: 'user_access_list'},
        ],
       },
      {path: '/change_password', component: USER_PASSWORD_CHANGE, name: 'change_password'},
      { path: '/project_management', component: PROJECT_MANAGEMENT,
        children:[
          {path: '', component: PROJECT_MANAGEMENT_LIST, name: 'project_management'},
          {path: 'add', component: PROJECT_MANAGEMENT_ENCODING, name: 'project_management_encoding'},
          {path: 'print', component: PROJECT_MANAGEMENT_PRINT, name: 'project_management_print'},
        ],
      },
      {
        path: '/facts_and_figure', component: FACTS_AND_FIGURE,
        children: [
          { path: '', component: GENERAL_INFORMATION,
            children:[
              {path: '', component: GENERAL_INFORMATION_ENCODING, name: 'general_information_encoding'},
            ],
          },
          { path: 'institutional_profile', component: INSTITUTIONAL_PROFILE,
            children:[
              {path: '', component: INSTITUTIONAL_PROFILE_PERSONNEL, name: 'personnel_by_office'},
              {path: 'personnel_by_status', component: INSTITUTIONAL_PROFILE_PERSONNEL_BY_STATUS, name: 'personnel_by_status'},
            ],
          },
          
          
          { path: 'economic_profile', component: ECONOMIC_PROFILE,
            children:[
              {path: '', component: ECONOMIC_PROFILE_RICE_AREA_CITY, name: 'rice_area_city'},
              {path: 'irrigated_area', component: ECONOMIC_PROFILE_IRRIGATED_AREA, name: 'irrigated_area'},
              {path: 'rice_production', component: ECONOMIC_PROFILE_RICE_PRODUCTION, name: 'rice_production'},
              {path: 'corn_production', component: ECONOMIC_PROFILE_CORN_PRODUCTION, name: 'corn_production'},
              {path: 'vegetable_production', component: ECONOMIC_PROFILE_VEGETABLE_PRODUCTION, name: 'vegetable_production'},
              {path: 'coconut_production', component: ECONOMIC_PROFILE_COCONUT_PRODUCTION, name: 'coconut_production'},
              {path: 'high_value_commercial_crops', component: ECONOMIC_PROFILE_HIGH_VALUE_COMMERCIAL_CROPS, name: 'high_value_commercial_crops'},
              {path: 'accommodation_establishments', component: ECONOMIC_PROFILE_ACCOMODATION_ESTABLISHMENT, name: 'accommodation_establishments'},
              {path: 'tourist_sites_and_destinations', component: ECONOMIC_PROFILE_TOURIST_SITES_AND_DESTINATION, name: 'tourist_sites_and_destinations'},
              {path: 'number_of_banks_and_atm', component: ECONOMIC_PROFILE_NUMBER_OF_BANKS_AND_ATM, name: 'number_of_banks_and_atm'},
              {path: 'commerce_and_industry', component: ECONOMIC_PROFILE_COMMERCE_AND_INDUSTRY, name: 'commerce_and_industry'},
              {path: 'top_five_product', component: ECONOMIC_PROFILE_TOP_FIVE_PRODUCT, name: 'top_five_product'},
              {path: 'top_five_fruit_areas', component: ECONOMIC_PROFILE_TOP_FIVE_FRUIT_AREAS, name: 'top_five_fruit_areas'},
            ],
          },

          { path: 'financial_profile', component: FINANCIAL_PROFILE,
            children:[
              {path: '', component: FINANCIAL_PROFILE_ANNUAL_INCOME, name: 'annual_income_budget'},
              {path: 'income_and_expenditures', component: FINANCIAL_PROFILE_INCOME_AND_EXPENDITURE, name: 'income_and_expenditures'},
            ],
          },

          { path: 'utilities_and_infrustructure', component: INFRASTRUCTURE_AND_UTILITIES,
            children:[
              {path: '', component: INFRASTRUCTURE_AND_UTILITIES_REGISTERED_VIHICLE, name: 'registered_vehicle'},
              {path: 'water_system', component: INFRASTRUCTURE_AND_UTILITIES_WATER_SYSTEM, name: 'water_system'},
              {path: 'communication', component: INFRASTRUCTURE_AND_UTILITIES_COMMUNICATION, name: 'communication'},
              {path: 'status_of_power', component: INFRASTRUCTURE_AND_UTILITIES_STATUS_OF_POWER, name: 'status_of_power'},
              {path: 'energized_and_unenergized_barangay_sitios', component: INFRASTRUCTURE_AND_UTILITIES_ENERGIZED_AND_UNENERGIZED_BARANGAY, name: 'energized_and_unenergized_barangay_sitios'},
              {path: 'household_population_by_source_of_drinking_waters', component: INFRASTRUCTURE_AND_UTILITIES_HOUSEHOLD_POPULATION_BY_SOURCE_OF_DRINKING_WATERS, name: 'household_population_by_source_of_drinking_waters'},
              {path: 'present_source_of_powers', component: INFRASTRUCTURE_AND_UTILITIES_PRESENT_SOURCE_OF_POWERS, name: 'present_source_of_powers'},
              {path: 'power_substations', component: INFRASTRUCTURE_AND_UTILITIES_POWER_SUBSTATIONS, name: 'power_substations'},
              {path: 'list_of_ratio_stations_and_cable_tv_networks', component: INFRASTRUCTURE_AND_UTILITIES_LIST_OF_RATIO_STATIONS_AND_CABLE_TV_NETWORKS, name: 'list_of_ratio_stations_and_cable_tv_networks'},
              {path: 'license_permit_issueds', component: INFRASTRUCTURE_AND_UTILITIES_LICENSE_PERMIT_ISSUEDS, name: 'license_permit_issueds'},
            ],
          },


          { path: 'demograph', component: DEMOGRAPH,
            children:[
              {path: '', component: DEMOGRAPH_ANCESTRAL_DOMAIN, name: 'ancestral_domain'},
              {path: 'population_by_census_year', component: DEMOGRAPH_POPULATION_BY_CENSUS_YEAR, name: 'population_by_census_year'},
              {path: 'household_population_by_sexes', component: DEMOGRAPH_HOUSEHOLD_POPULATION_BY_SEXES, name: 'household_population_by_sexes'},
              {path: 'mangyan_tribes', component: DEMOGRAPH_MANGYAN_TRIBES, name: 'mangyan_tribes'},
              {path: 'actual_projecteds', component: DEMOGRAPH_ACTUAL_PROJECTEDS, name: 'actual_projecteds'},
              {path: 'population_densities', component: DEMOGRAPH_POPULATION_DENSITIES, name: 'population_densities'},
              {path: 'projected_populations', component: DEMOGRAPH_PROJECTED_POPULATIONS, name: 'projected_populations'},
              {path: 'urban_rural_populations', component: DEMOGRAPH_URBAN_RURAL_POPULATIONS, name: 'urban_rural_populations'},
            ],

          },
          { path: 'land_and_other_natural_resources', component: LAND_AND_OTHER_NATURAL_RESOURCES,
            children:[
              {path: '', component: LAND_AND_OTHER_NATURAL_RESOURCES_MUNICIPALITIES, name: 'land_and_other_natural_resources'},
              {path: 'land_classification_statistic', component: LAND_AND_OTHER_NATURAL_RESOURCES_LAND_CLASSIFICATION_STATISTICS, name: 'land_classification_statistic'},
              {path: 'geographical_zone_surface', component: LAND_AND_OTHER_NATURAL_RESOURCES_GEOGRAPHICAL_ZONE_SURFACES, name: 'geographical_zone_surface'},
              {path: 'non_metalic_minerals', component: LAND_AND_OTHER_NATURAL_RESOURCES_NON_METALLIC_MINERALS, name: 'non_metalic_minerals'},
              {path: 'major_watershed', component: LAND_AND_OTHER_NATURAL_RESOURCES_MAJOR_WATERSHEDS, name: 'major_watershed'},
              {path: 'marine_protected_areas', component: LAND_AND_OTHER_NATURAL_RESOURCES_MARINE_PROTECTED_AREAS, name: 'marine_protected_areas'},
              {path: 'established_marine_protected_areas', component: LAND_AND_OTHER_NATURAL_RESOURCES_ESTABLISHED_MARINE_PROTECTED_AREAS, name: 'established_marine_protected_areas'},
              {path: 'forest_covers', component: LAND_AND_OTHER_NATURAL_RESOURCES_FOREST_COVERS, name: 'forest_covers'},
              {path: 'metallic_mineral_resources', component: LAND_AND_OTHER_NATURAL_RESOURCES_METALLIC_MINERAL_RESOURCES, name: 'metallic_mineral_resources'},
            ],
          },


          { path: 'social_development_profile', component: SOCIAL_DEVELOPMENT_PROFILE,
            children:[
              {path: '', component: SOCIAL_DEVELOPMENT_PROFILE_COMPARATIVE_LABOR_FORCE_PARTICIPATION, name: 'social_development_profile'},
              {path: 'comparative_employment_statuses', component: SOCIAL_DEVELOPMENT_PROFILE_COMPARATIVE_EMPLOYMENT_STATUSES, name: 'comparative_employment_statuses'},
              {path: 'poverty_incidences', component: SOCIAL_DEVELOPMENT_PROFILE_POVERTY_INCIDENCES, name: 'poverty_incidences'},
              {path: 'number_rate_bdimds', component: SOCIAL_DEVELOPMENT_PROFILE_NUMBER_RATE_BDIMDS, name: 'number_rate_bdimds'},
              {path: 'doh_licensed_health_facilities', component: SOCIAL_DEVELOPMENT_PROFILE_DOH_LICENSED_HEALTH_FACILITIES, name: 'doh_licensed_health_facilities'},
              {path: 'nutritional_status', component: SOCIAL_DEVELOPMENT_PROFILE_NUTRITIONAL_STATUS, name: 'nutritional_status'},
              {path: 'health_facilities', component: SOCIAL_DEVELOPMENT_PROFILE_HEALTH_FACILITIES, name: 'health_facilities'},
              {path: 'senior_citizen_and_person_with_disabilities', component: SOCIAL_DEVELOPMENT_PROFILE_SENIOR_CITIZEN_AND_PERSON_WITH_DISABILITIES, name: 'senior_citizen_and_person_with_disabilities'},
              {path: 'crime_statistics_and_protective_facilities', component: SOCIAL_DEVELOPMENT_PROFILE_CRIME_STATISTICS_AND_PROTECTIVE_FACILITIES, name: 'crime_statistics_and_protective_facilities'},
              {path: 'education_facilities', component: SOCIAL_DEVELOPMENT_PROFILE_EDUCATION_FACILITIES, name: 'education_facilities'},
              {path: 'enrollment_in_government_and_private_schools', component: SOCIAL_DEVELOPMENT_PROFILE_ENROLLMENT_IN_GOVERNMENT_AND_PRIVATE_SCHOOLS, name: 'enrollment_in_government_and_private_schools'},
              {path: 'performance_indicator_in_public_schools', component: SOCIAL_DEVELOPMENT_PROFILE_PERFORMANCE_INDICATOR_IN_PUBLIC_SCHOOLS, name: 'performance_indicator_in_public_schools'},
              {path: 'health_morbidities', component: SOCIAL_DEVELOPMENT_PROFILE_HEALTH_MORBIDITIES, name: 'health_morbidities'},
              {path: 'health_infant_morbidities', component: SOCIAL_DEVELOPMENT_PROFILE_HEALTH_INFANT_MORBIDITIES, name: 'health_infant_morbidities'},
              {path: 'health_mortalities', component: SOCIAL_DEVELOPMENT_PROFILE_HEALTH_MORTALITIES, name: 'health_mortalities'},
              {path: 'health_infant_mortalities', component: SOCIAL_DEVELOPMENT_PROFILE_HEALTH_INFANT_MORTALITIES, name: 'health_infant_mortalities'},
              {path: 'dimensions_of_poverties', component: SOCIAL_DEVELOPMENT_PROFILE_DIMENSIONS_OF_POVERTIES, name: 'dimensions_of_poverties'},
              {path: 'fire_preventions', component: SOCIAL_DEVELOPMENT_PROFILE_FIRE_PREVENTIONS, name: 'fire_preventions'},
              {path: 'social_welfare_services', component: SOCIAL_DEVELOPMENT_PROFILE_SOCIAL_WELFARE_SERVICES, name: 'social_welfare_services'},
            ],
          },
        ],
      },
	]
});


// router.beforeEach((to, from, next) => {
// 	var auth_state = to.matched.some(record => record.meta.auth);
// 	if(auth_state == true && store.state.AUTH_STATUS == false)
// 	{
// 		next("/login")
// 	}else{
// 		next();
// 	}
// })



export default router;