<template>
	<div id="population_by_census_year">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Oriental Mindoro Population by City/Municipality, by Census Years</h5>
					<small>Source: Philippine Statistics Authority</small>
				</div>
				</div>
			<table class="table table-bordered table-light mt-1">
				<thead class="text-center">
						<tr>
							<th rowspan="2">Municipality</th>
							<th :colspan="population_by_census_year['year'].length">Census Year</th>
						</tr>
						<tr>
							<template v-for="year in population_by_census_year['year']">
								<th>{{year}}</th>
							</template>
						</tr>
				</thead>
				<template v-for="(data, key) in population_by_census_year['data']">
					<tr>
						<td>{{key}}</td>
						<template v-for="(year, keyYear) in data">
							<td><currency_label :data="year.population"></currency_label></td>
						</template>
					</tr>
				</template>
				
				<tbody v-if="population_by_census_year['data'].length <= 0">
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
				population_by_census_year: {
						year: [],
						data: [],
					},
			}
		},
		methods:{
			getInfo: function(){
				var vm = this;
				axios.post('/demograph/population_by_census_year/get')
						.then(data => {
							vm.population_by_census_year = data.data;
						})
			},
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