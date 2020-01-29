<template>
	<div id="population_by_census_year">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Oriental Mindoro Population by City/Municipality, by Census Years</h5>
					<small>Source: Philippine Statistics Authority</small>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-4 col-md-3 col-lg-2 col-xl-2 ml-auto pr-1">
						<div class="form-group p-0 m-0">
							<span>Year: </span> 
							<v-select  v-model="year" :options="defaultYear"></v-select>
							<!-- <select class="form-control" v-model="year">
								<option value="" disabled selected>-- Select Year --</option>
								<option v-for="item in defaultYear" :value="item">{{item}}</option>
							</select> -->
						</div>
					</div>
					<div class="col-auto d-flex align-items-end p-0">
						<div class="col">
							<button class="btn btn-primary" @click="addYear">Add new year</button>
							<button class="btn btn-info" @click="updateInfo">Update</button>
						</div>
					</div>
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
						<td class="with-input"><currency_input v-model="year.population"></currency_input></td>
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
				year: new Date().getFullYear(),
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
			addYear: function(){
				var vm = this;
				axios.post('/demograph/population_by_census_year/create', {year: vm.year})
						.then(data => {
							vm.$toastr('success', 'New year is now added!', 'Oriental Mindoro Population by City/Municipality, by Census Years')
							vm.getInfo();
						})
			},
			updateInfo: function(){
				var vm = this;

				axios.post('/demograph/population_by_census_year/udate',{data: vm.population_by_census_year["data"]})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'Oriental Mindoro Population by City/Municipality, by Census Years')

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