<template>
	<div id="household_population_by_sexes">
		 	<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">House Hold Population by Sex</h5>
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
						<td class="with-input"><currency_input v-model="year.male"></currency_input></td>
						<td class="with-input"><currency_input v-model="year.female"></currency_input></td>
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
				year: new Date().getFullYear(),
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
			},
			updateInfo: function(){
				var vm = this;

				axios.post('/demograph/household_population_by_sexes/update',{data: vm.household_population_by_sexes["data"]})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'House Hold Population by Sex')
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