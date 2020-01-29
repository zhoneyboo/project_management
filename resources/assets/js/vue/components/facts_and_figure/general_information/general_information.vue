<style>
	body{
		background-color: #f2f2f2;
	}
</style>
<template>
	<div id="general_information" class="mt-2">
		<template v-if="general_information.location != undefined">
			<div class="card bg-info">
				<div class="card-body p-3">
					<h4 class="font-weight-bold text-white">GENERAL INFORMATION</h4>
				</div>
			</div>
			<br>
			<h5 class="font-weight-bold">Location</h5>
			<p>{{general_information.location}}</p>
			<h5 class="font-weight-bold">Topography</h5>
			<p>{{general_information.topography}}</p>
			<h5 class="font-weight-bold">Land Area</h5>
			<p>{{general_information.land_area}}</p>
			<h5 class="font-weight-bold">Boundary</h5>
			<p>{{general_information.boundary}}</p>
			<h5 class="font-weight-bold">Climate</h5>
			<p>{{general_information.climate}}</p>
			<h5 class="font-weight-bold">Capital</h5>
			<p>{{general_information.capital}}</p>
			<h5 class="font-weight-bold">Date of Approval</h5>
			<p>{{general_information.date_of_approval}}</p>
			<h5 class="font-weight-bold">Legal Basis</h5>
			<p>{{general_information.legal_basis}}</p>
			<h5 class="font-weight-bold">{{general_information.no_of_component_city}} Component City</h5>
			<h5 class="font-weight-bold">{{general_information.no_of_municipality}} Municipalities</h5>
			<h5 class="font-weight-bold">{{general_information.no_of_congressional_district}} Two Congressional Districts</h5>
			<h5 class="font-weight-bold">{{general_information.no_of_barangay}} Barangays</h5>
		</template>
	</div>
</template>
<script>
	export default{
		data: function(){
			return {
				general_information : [],
			}
		},
		mounted: function(){
			this.getInfo();
		},
		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/general_information/getYear')
						.then(data => {
							vm.general_information = data.data;
						})

				console.log(vm.general_information.lenth)
			}
		},
		watch: {
			year: function(val){
				this.getInfo(val)
			}
		}
	}
</script>