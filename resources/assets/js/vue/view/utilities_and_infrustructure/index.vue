<template>
	<div id="utilities_and_infrustructure">
		<div class="header">
			<div class="card rounded-0 shadow-sm">
				<div class="card-body p-3">
					<h5 class="font-weight-bold text-uppercase">Utilities and Infrastracture</h5>
					<small>Note: This list all Provincial Governement of Oriental Mindoro General Information.</small>
				</div>
			</div>
			<div class="dropdown">
				<a class="btn btn-secondary dropdown-toggle rounded-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				   Utilities and Infrastructure link
				  </a>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<router-link class="dropdown-item" :to="{name:'registered_vehicle'}">Registered Motor Vehicles</router-link>
					<router-link class="dropdown-item" :to="{name:'water_system'}">Water System</router-link>
					<router-link class="dropdown-item" :to="{name:'communication'}">Communication</router-link>
					<router-link class="dropdown-item" :to="{name:'status_of_power'}">Status of Power</router-link>
					<router-link class="dropdown-item" :to="{name:'energized_and_unenergized_barangay_sitios'}">Energized and Unenergized</router-link>
					<router-link class="dropdown-item" :to="{name:'household_population_by_source_of_drinking_waters'}">Household Population by Source of Drinking Water</router-link>
					<router-link class="dropdown-item" :to="{name:'present_source_of_powers'}">Present Sources of Power</router-link>
					<router-link class="dropdown-item" :to="{name:'power_substations'}">Power Substations</router-link>
					<router-link class="dropdown-item" :to="{name:'list_of_ratio_stations_and_cable_tv_networks'}">List of radio stations and cable tv networks</router-link>
					<router-link class="dropdown-item" :to="{name:'license_permit_issueds'}">License/Permit issued</router-link>
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
		
	}
</script>