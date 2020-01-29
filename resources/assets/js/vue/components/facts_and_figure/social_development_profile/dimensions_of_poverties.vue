<template>
	<div id="dimensions_of_poverties">
		
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">The 13+ Dimenstions of Poverty, Oriental Mindor</h4>
			</div>
		</div>
		<table class="table table-bordered table-light mt-1">
			<thead >
				<tr>
					<th rowspan="3" class="text-center align-middle">Indicator</th>
					<th colspan="2" class="text-center align-middle">Households</th>
					<th colspan="6" class="text-center align-middle">Households</th>
				</tr>
				<tr>
					<th rowspan="2" class="text-center align-middle">Magnitude</th>
					<th rowspan="2" class="text-center align-middle">Proportion</th>
					<th colspan="3" class="text-center align-middle">Magnitude</th>
					<th colspan="3" class="text-center align-middle">Proportion</th>
				</tr>
				<tr>
					<th class="text-center align-middle">Total</th>
					<th class="text-center align-middle">Male</th>
					<th class="text-center align-middle">Female</th>
					<th class="text-center align-middle">Total</th>
					<th class="text-center align-middle">Male</th>
					<th class="text-center align-middle">Female</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="(data, key) in dimensions_of_poverties">
					<tr>
						<th>{{key}}</th>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<template v-for="item in data">
						<tr>
							<td>{{item.indicator}}</td>
							<td class="text-right">{{item.household_magnitude}}</td>
							<td class="text-right">{{item.household_proportion}}</td>

							<td class="text-center">{{parseFloat(item.population_magnitude_male) + parseFloat(item.population_magnitude_female) }}</td>

							<td class="text-right">{{item.population_magnitude_male}}</td>
							<td class="text-right">{{item.population_magnitude_female}}</td>

							<td class="text-center">{{parseFloat(item.population_proportion_male) + parseFloat(item.population_proportion_female) }}</td>

							<td class="text-right">{{item.population_proportion_male}}</td>
							<td class="text-right">{{item.population_proportion_female}}</td>
						</tr>
					</template>
				</template>
			</tbody>
		</table>
	</div>
</template>
<script>
	export default{
		data: function(){
			return {
				dimensions_of_poverties: [],
				year: ""
			}
		},
		methods: {
			getInfo: function(year){
				// var vm = this;
				// axios.post('/social_development/dimensions_of_poverties/get', {year: year})
				// 		.then(data => {
				// 			vm.dimensions_of_poverties = data.data;
				// 		})
			},
			updateInfo: function()
			{
				var vm = this;
				axios.post('/social_development/dimensions_of_poverties/update', {data: vm.dimensions_of_poverties})
						.then(data => {
							console.log(data.data);
						})
			}
		},
		mounted: function(){
			this.getInfo();
		},
		watch: {
			year: function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val)
				}
			}
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		}
	}
</script>