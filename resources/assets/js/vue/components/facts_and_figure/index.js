import Vue from 'vue';

import general_information from './general_information/general_information.vue'
Vue.component("general_information", general_information)

import print from './print/print.vue'
Vue.component("print", print)

import land_area_by_municipality from './land_and_other_natural_resources/land_area_by_municipality.vue'
import land_classification_statistic from './land_and_other_natural_resources/land_classification_statistic.vue'
import geographical_zone_surface from './land_and_other_natural_resources/geographical_zone_surface.vue'
Vue.component("land_area_by_municipality", land_area_by_municipality)
Vue.component("geographical_zone_surface", geographical_zone_surface)
Vue.component("land_classification_statistic", land_classification_statistic)

import forest_cover from './land_and_other_natural_resources/forest_cover.vue'
Vue.component("forest_cover", forest_cover)

import major_watershed from './land_and_other_natural_resources/major_watershed.vue'
Vue.component("major_watershed", major_watershed)

import marine_protected_areas from './land_and_other_natural_resources/marine_protected_areas.vue'
Vue.component("marine_protected_areas", marine_protected_areas)


import established_marine_protected_areas from './land_and_other_natural_resources/established_marine_protected_areas.vue'
Vue.component("established_marine_protected_areas", established_marine_protected_areas)


import rice_area_city from './economic_profile/rice_area_city.vue'
Vue.component("rice_area_city", rice_area_city)

import irrigated_area from './economic_profile/irrigated_area.vue'
Vue.component("irrigated_area", irrigated_area)


import corn_production from './economic_profile/corn_production.vue'
Vue.component("corn_production", corn_production)

import vegetable_production from './economic_profile/vegetable_production.vue'
Vue.component("vegetable_production", vegetable_production)

import high_value_commercial_crops from './economic_profile/high_value_commercial_crops.vue'
Vue.component("high_value_commercial_crops", high_value_commercial_crops)

import accommodation_establishments from './economic_profile/accommodation_establishments.vue'
Vue.component("accommodation_establishments", accommodation_establishments)

import tourist_sites_and_destinations from './economic_profile/tourist_sites_and_destinations.vue'
Vue.component("tourist_sites_and_destinations", tourist_sites_and_destinations)

import commerce_and_industry from './economic_profile/commerce_and_industry.vue'
Vue.component("commerce_and_industry", commerce_and_industry)

import top_five_products from './economic_profile/top_five_products.vue'
Vue.component("top_five_products", top_five_products)

import top_five_fruit_areas from './economic_profile/top_five_fruit_areas.vue'
Vue.component("top_five_fruit_areas", top_five_fruit_areas)

import banks_and_atms from './economic_profile/banks_and_atms.vue'
Vue.component("banks_and_atms", banks_and_atms)

import registered_vechicle from './utilities_and_infrustructure/registered_vechicle.vue'
Vue.component("registered_vechicle", registered_vechicle)

import license_permit_issueds from './utilities_and_infrustructure/license_permit_issueds.vue'
Vue.component("license_permit_issueds", license_permit_issueds)

import communication from './utilities_and_infrustructure/communication.vue'
Vue.component("communication", communication)

import water_system from './utilities_and_infrustructure/water_system.vue'
Vue.component("water_system", water_system)

import household_population_by_source_of_drinking_waters from './utilities_and_infrustructure/household_population_by_source_of_drinking_waters.vue'
Vue.component("household_population_by_source_of_drinking_waters", household_population_by_source_of_drinking_waters)

import status_of_power from './utilities_and_infrustructure/status_of_power.vue'
Vue.component("status_of_power", status_of_power)

import energized_and_unenergized_barangay_sitios from './utilities_and_infrustructure/energized_and_unenergized_barangay_sitios.vue'
Vue.component("energized_and_unenergized_barangay_sitios", energized_and_unenergized_barangay_sitios)

import present_source_of_powers from './utilities_and_infrustructure/present_source_of_powers.vue'
Vue.component("present_source_of_powers", present_source_of_powers)

import power_substations from './utilities_and_infrustructure/power_substations.vue'
Vue.component("power_substations", power_substations)


import annual_income_budget from './financial_profile/annual_income_budget.vue'
Vue.component("annual_income_budget", annual_income_budget)

import income_and_expenditure from './financial_profile/income_and_expenditure.vue'
Vue.component("income_and_expenditure", income_and_expenditure)


import personnel_by_status from './institutional_profile/personnel_by_status.vue'
Vue.component("personnel_by_status", personnel_by_status)


import personnel_by_office from './institutional_profile/personnel_by_office.vue'
Vue.component("personnel_by_office", personnel_by_office)


// SOCIAL DEVELOPMENT


import dimensions_of_poverties from './social_development_profile/dimensions_of_poverties.vue'
Vue.component("dimensions_of_poverties", dimensions_of_poverties)

import health_morbidities from './social_development_profile/health_morbidities.vue'
Vue.component("health_morbidities", health_morbidities)

import health_infant_morbidities from './social_development_profile/health_infant_morbidities.vue'
Vue.component("health_infant_morbidities", health_infant_morbidities)

import health_mortalities from './social_development_profile/health_mortalities.vue'
Vue.component("health_mortalities", health_mortalities)

import health_infant_mortalities from './social_development_profile/health_infant_mortalities.vue'
Vue.component("health_infant_mortalities", health_infant_mortalities)

import nutritional_status from './social_development_profile/nutritional_status.vue'
Vue.component("nutritional_status", nutritional_status)

import health_facilities from './social_development_profile/health_facilities.vue'
Vue.component("health_facilities", health_facilities)

import doh_licensed_health_facilities from './social_development_profile/doh_licensed_health_facilities.vue'
Vue.component("doh_licensed_health_facilities", doh_licensed_health_facilities)

import education_facilities from './social_development_profile/education_facilities.vue'
Vue.component("education_facilities", education_facilities)

import enrollment_in_government_and_private_schools from './social_development_profile/enrollment_in_government_and_private_schools.vue'
Vue.component("enrollment_in_government_and_private_schools", enrollment_in_government_and_private_schools)

import performance_indicator_in_public_schools from './social_development_profile/performance_indicator_in_public_schools.vue'
Vue.component("performance_indicator_in_public_schools", performance_indicator_in_public_schools)


import social_welfare_services from './social_development_profile/social_welfare_services.vue'
Vue.component("social_welfare_services", social_welfare_services)

import senior_citizen_and_person_with_disabilities from './social_development_profile/senior_citizen_and_person_with_disabilities.vue'
Vue.component("senior_citizen_and_person_with_disabilities", senior_citizen_and_person_with_disabilities)

import crime_statistics_and_protective_facilities from './social_development_profile/crime_statistics_and_protective_facilities.vue'
Vue.component("crime_statistics_and_protective_facilities", crime_statistics_and_protective_facilities)

import fire_preventions from './social_development_profile/fire_preventions.vue'
Vue.component("fire_preventions", fire_preventions)



import actual_projecteds from './demograph/actual_projecteds.vue'
Vue.component("actual_projecteds", actual_projecteds)

import ancestral_domain from './demograph/ancestral_domain.vue'
Vue.component("ancestral_domain", ancestral_domain)

import household_population_by_sexes from './demograph/household_population_by_sexes.vue'
Vue.component("household_population_by_sexes", household_population_by_sexes)

import mangyan_tribes from './demograph/mangyan_tribes.vue'
Vue.component("mangyan_tribes", mangyan_tribes)

import population_by_census_year from './demograph/population_by_census_year.vue'
Vue.component("population_by_census_year", population_by_census_year)

import population_densities from './demograph/population_densities.vue'
Vue.component("population_densities", population_densities)

import projected_populations from './demograph/projected_populations.vue'
Vue.component("projected_populations", projected_populations)

import urban_rural_populations from './demograph/urban_rural_populations.vue'
Vue.component("urban_rural_populations", urban_rural_populations)