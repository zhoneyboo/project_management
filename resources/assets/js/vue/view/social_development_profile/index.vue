<template>
	<div id="social_development_profile">
		<div class="header">
			<div class="card rounded-0 shadow-sm">
				<div class="card-body p-3">
					<h5 class="font-weight-bold text-uppercase">Social Development Profile</h5>
					<small>Note: This list all Provincial Governement of Oriental Mindoro General Information.</small>
				</div>
			</div>
			<div class="dropdown">
				<a class="btn btn-secondary dropdown-toggle rounded-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				   {{selected_name}}
				  </a>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<router-link class="dropdown-item" :to="{name:'social_development_profile'}">Comparative Labor Force</router-link>
					<router-link class="dropdown-item" :to="{name:'comparative_employment_statuses'}">Comparative Employment Status of Household</router-link>
					<router-link class="dropdown-item" :to="{name:'poverty_incidences'}">Poverty Incidence</router-link>
					<router-link class="dropdown-item" :to="{name:'number_rate_bdimds'}">Number of Rate of Births </router-link>
					<router-link class="dropdown-item" :to="{name:'doh_licensed_health_facilities'}">DOH-Licensed Health Facilities</router-link>
					<router-link class="dropdown-item" :to="{name:'nutritional_status'}">Nutritional Status</router-link>
					<router-link class="dropdown-item" :to="{name:'health_facilities'}">Health Facilities</router-link>
					<router-link class="dropdown-item" :to="{name:'senior_citizen_and_person_with_disabilities'}">Registered Senior Citizens & Person with Disability</router-link>
					<router-link class="dropdown-item" :to="{name:'crime_statistics_and_protective_facilities'}">Crime Statistics and Protective Facilities</router-link>
					<router-link class="dropdown-item" :to="{name:'education_facilities'}">Education Facilities</router-link>
					<router-link class="dropdown-item" :to="{name:'enrollment_in_government_and_private_schools'}">Enrollment in Government and Private Schools by Level of Education</router-link>
					<router-link class="dropdown-item" :to="{name:'performance_indicator_in_public_schools'}">Performance Indicators in Public Elementary and Second Schools</router-link>
					<router-link class="dropdown-item" :to="{name:'health_morbidities'}">Morbidity</router-link>
					<router-link class="dropdown-item" :to="{name:'health_infant_morbidities'}">Infant Morbidity</router-link>
					<router-link class="dropdown-item" :to="{name:'health_mortalities'}">Mortality</router-link>
					<router-link class="dropdown-item" :to="{name:'health_infant_mortalities'}">Infant Mortality</router-link>
					
					<router-link class="dropdown-item" :to="{name: 'dimensions_of_poverties'}">Dimensions of Poverty</router-link>
					<router-link class="dropdown-item" :to="{name:'fire_preventions'}">Fire Prevention</router-link>
					<router-link class="dropdown-item" :to="{name:'social_welfare_services'}">Social Welfare Services</router-link>


				</div>
			</div>
			<div class="content">
				<router-view></router-view>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		data: function(){
			return {
				selected_name: 'Social Development Link',
			}
		},
		methods: {

			changeLink: function(name, link){
				this.$router.push({name: link});
			}

		},
		mounted: function(){
			this.selected_name = 'Social Development Link';
		}

	}
</script>