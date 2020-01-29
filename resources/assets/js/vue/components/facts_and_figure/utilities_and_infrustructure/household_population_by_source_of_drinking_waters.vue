<template>
	<div id="household_population_by_source_of_drinking_waters">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Household Population by Source of Drinking Water</h4>
			</div>
		</div>
		<table class="table table-bordered table-light">
			<thead class="text-center">
				<tr>
					<th rowspan="2" class="align-middle">Source of Drinking Water</th>
					<th colspan="3">Household Population</th>
				</tr>
				<tr>
					<th>Magnitude*</th>
					<th>Proportion**</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="item in household_population_by_source_of_drinking_waters">
					<td>{{item.source_of_drinking}}</td>
					<td class="text-right">{{item.magnitude}}</td>
					<td class="text-right">{{item.proportion}}</td>
				</tr>
				<tr v-if="household_population_by_source_of_drinking_waters.length <= 0">
					<td colspan="4" class="text-center">
						No item found
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
<script>
	export default{
		props: ["year"],
		data: function(){
			return {
				updateInfo: false,
				household_population_by_source_of_drinking_waters: []
			}
		},
		mounted: function(){
			this.getInfo();
		},

		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/infrustructure_and_utilities/household_population_by_source_of_drinking_waters/get',{year:year})
					.then(data => {
						vm.household_population_by_source_of_drinking_waters = data.data;
					})
			}
		},
		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch: {
			year: function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			}
		}
	}
</script>