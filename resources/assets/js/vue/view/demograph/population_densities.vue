<!-- population_densities -->

<template>
	<div id="population_density_infos">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Population Density</h5>
			</div>
		</div>

		<div class="row mt-1">
			<div class="col-md">
				<div class="container">
					<div class="row">
						<div class="col-4 col-md-3 col-lg-2 col-xl-2 ml-auto pr-1">
							<div class="form-group p-0 m-0">
								<span>Year: </span> 
								<!-- <v-select  v-model="year" :options="defaultYear"></v-select> -->
								
								<select class="form-control" v-model="year">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in webYear" :value="item.actual_year">{{item.old_year}} - {{item.actual_year}}</option>
								</select>
							</div>
						</div>
						<div class="col-auto d-flex align-items-end p-0">
							<div class="col">
								<button class="btn btn-info" @click="updateInfo" v-if="population_densities.length > 0">Update</button>
								<button class="btn btn-info" @click="clearYear">New</button>
							</div>
						</div>
					</div>
				</div>

				<table class="table table-light table-bordered mt-1">
					<thead class="text-center">
						<tr>
							<th rowspan="2">City/Municipality</th>
							<th colspan="2">Gross Population Density <br>(per sq. km.)</th>
							<th colspan="2">Urban Population Density <br>(per sq. km.)</th>
							<th>Estimated Gross <br>Population Density</th>
						</tr>
						<tr>
							<th>{{population_density_infos.old_year}}</th>
							<th>{{population_density_infos.actual_year}}</th>
							<th>{{population_density_infos.old_year}}</th>
							<th>{{population_density_infos.actual_year}}</th>
							<th>{{population_density_infos.estimated}}</th>
						</tr>
					</thead>
					<tbody>
						<template v-if="population_densities.length <= 0">
							<tr>
								<td colspan="9">No year selected</td>
							</tr>
						</template>
						<template v-for="item in population_densities">
							<template v-if="item.municipality == 1">
								<tr>
									<th colspan="9">1st District</th>
								</tr>
							</template>
							<template v-if="item.municipality == 9">
								<tr>
									<th colspan="9">2nd District</th>
								</tr>
							</template>
							<tr>
								<td>{{item.municipality_name}}</td>
								<td class="with-input"><currency_input v-model="item.gross_old"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.gross_actual"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.urban_old"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.urban_actual"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.estimated_gross"></currency_input></td>
							</tr>
						</template>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row"  v-if="population_densities.length <= 0">
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<form @submit.prevent="submitInfo">
							<p class="font-weight-bold">CREATE INFO FORM</p>
							<div class="form-group">
								<label>Old Year</label>
								<select class="form-control" v-model="form.old_year">
									<option value="" selected disabled>-- Select Old Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
							<div class="form-group">
								<label>Actual Year</label>
								<select class="form-control" v-model="form.actual_year">
									<option value="" selected disabled>-- Select Actual Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
							<div class="form-group">
								<label>Estimated Year</label>
								<select class="form-control" v-model="form.estimated">
									<option value="" selected disabled>-- Select Estimated Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
							<div class="row justify-content-end">
								<div class="col-auto">
									<button class="btn btn-primary" type="submit">Create</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>	
</template>

<script>
	export default{
		data : function(){
			return {
				year: "",
				population_densities: [],
				population_density_infos: [],
				form: {
					old_year: '',
					actual_year: '',
					estimated: '',
				},
				webYear: [],
			}
		},
		methods: {
			submitInfo: function(){
				var vm = this;
				axios.post('/demograph/population_densities/create', vm.form)
						.then(data => {
							vm.$toastr('success', 'Information is now added!', 'Population Density')
							vm.getYear();
						});
			},
			getInfo: function(actual_year){
				var vm = this;
				axios.post('/demograph/population_densities/get',{actual_year: actual_year} )
						.then(data => {
							vm.population_densities = data.data.population_densities;
							vm.population_density_infos = data.data.population_density_infos;
							vm.getYear();

						});
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/demograph/population_densities/update', {data: vm.population_densities})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'Population Density')
							vm.getYear();
						})
			},
			getYear: function(){
				var vm = this;
				axios.post('/demograph/population_densities/getYear')
				.then(data => {
					vm.webYear = data.data;
				})
			},
			clearYear: function(){
				this.year = ""
			}	
		},
		watch: {
			year: function(val){
				if(val != "")
				{
					this.getInfo(val);
					this.getYear();
				}else{
					this.getYear();
					this.getInfo();
				}
			}
		},
		mounted: function(){
			this.getYear();
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		}
	}
</script>

