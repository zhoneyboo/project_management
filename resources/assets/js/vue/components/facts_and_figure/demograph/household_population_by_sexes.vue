<template>
	<div id="household_population_by_sexes">
		 	<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">House Hold Population by Sex</h5>
				</div>
			</div>
			<table class="table table-bordered table-light mt-1">
				<thead class="text-center">
						<tr>
							<th rowspan="2">Municipality</th>
							<template v-for="year in household_population_by_sexes['year']">
								<th colspan="3">{{year}}</th>
							</template>
						</tr>
						<tr>
							<template v-for="year in household_population_by_sexes['year']">
								<th>Total HH Population</th>
								<th>Male</th>
								<th>Female</th>
							</template>
						</tr>
				</thead>
				<template v-for="(data, key) in household_population_by_sexes['data']">
					<tr>
						<td>{{key}}</td>
						<template v-for="(year, keyYear) in data">
							<td>{{(parseFloat(year.female) + parseFloat(year.male) )}}</td>
							<td><currency_label v-model="year.male"></currency_label></td>
							<td><currency_label v-model="year.female"></currency_label></td>
						</template>
					</tr>
				</template>
				<tbody v-if="household_population_by_sexes['data'].length <= 0">
					<tr>
						<td>No item added</td>
					</tr>
				</tbody>
			</table>
	</div>
</template>
<script>
	export default{
		data: function(){
			return {
				household_population_by_sexes: {
						year: [],
						data: [],
					},
			}
		},
		methods:{
			getInfo: function(){
				var vm = this;
				axios.post('/demograph/household_population_by_sexes/get')
						.then(data => {
							vm.household_population_by_sexes = data.data;
						})
			},
			addYear: function(){
				var vm = this;
				axios.post('/demograph/household_population_by_sexes/create', {year: vm.year})
						.then(data => {
							vm.$toastr('success', 'New year is now added!', 'House Hold Population by Sex')
							vm.getInfo();
						})
			}
		},
		mounted: function(){
			this.getInfo();
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		}
	}
</script>