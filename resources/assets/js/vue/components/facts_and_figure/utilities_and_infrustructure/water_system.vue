<template>
	<div id="water_system">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Level III Water System by City/Municipality</h4>
			</div>
		</div>
		<table class="table table-light table-bordered">
			<thead>
				<tr>
					<th>City/Municipality</th>
					<th>Water Service Provider</th>
					<th>Type of Water Facility</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="(data, key) in water_system">
					<template v-for="(item, index) in data">
						<tr v-if="index == 0">
							<td>{{key}}</td>
							<td>{{item.water_service_provider}}</td>
							<td>
								<template v-if="item.type_of_water_facility == 1">Pressure Pump</template>
								<template v-if="item.type_of_water_facility == 2">Gravity-fed</template>
								<template v-if="item.type_of_water_facility == 3">Pressure Pump/Gravity-fed</template>
							</td>
						</tr>
						<tr v-if="index > 0">
							<td></td>
							<td>{{item.water_service_provider}}</td>
							<td>
								<template v-if="item.type_of_water_facility == 1">Pressure Pump</template>
								<template v-if="item.type_of_water_facility == 2">Gravity-fed</template>
								<template v-if="item.type_of_water_facility == 3">Pressure Pump/Gravity-fed</template>
							</td>
						</tr>
					</template>
				</template>
				<tr v-if="water_system.length <= 0">
					<td colspan="4" class="text-center">No item found!</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
<script>
	export default {
		props: ["year"],
		data:function(){
			return {
				water_system: [],
				municipality: [],
				updateSelected: false
			}
		},
		methods:{
			getInfo: function(year){
				var vm = this;
				axios.post('/infrustructure_and_utilities/water_system/get', {year: year})
						.then(data => {
							vm.water_system = data.data;
						})
			},
		},
		mounted: function(){
			this.getInfo();
		},
		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch:{
			year:function(val){
				this.getInfo(val)
			}
		}
		
	}
</script>