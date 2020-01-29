<template>
	<div id="projected_population_infos">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Projected Population by Province, MIMAROPA</h5>
			</div>
		</div>
		<div class="row mt-1">
			<div class="col-md">
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
								<button class="btn btn-info" @click="updateInfo" v-if="projected_populations.length > 0">Update</button>
							</div>
						</div>
					</div>
				</div>
				<table class="table table-light table-bordered mt-1">
					<thead class="text-center">
						<tr>
							<th class="align-middle" rowspan="2">Province</th>
							<th class="align-middle" colspan="2">Actual Population</th>
							<th class="align-middle">Growth Rate</th>
							<th class="align-middle" colspan="3">Population Projection</th>
						</tr>
						<tr>
							<th>{{projected_population_infos.actual_year_1}}</th>
							<th>{{projected_population_infos.actual_year_2}}</th>
							<th>{{projected_population_infos.growth_rate}}</th>
							<th>{{projected_population_infos.projection_year_1}}</th>
							<th>{{projected_population_infos.projection_year_2}}</th>
							<th>{{projected_population_infos.projection_year_3}}</th>
						</tr>
					</thead>
					<tbody>
						<template v-if="projected_populations.length <= 0">
							<tr>
								<td colspan="7">No year selected</td>
							</tr>
						</template>
						<template v-for="item in projected_populations">
							<template v-if="item.municipality == 1">
								<tr>
									<th colspan="7">1st District</th>
								</tr>
							</template>
							<template v-if="item.municipality == 9">
								<tr>
									<th colspan="7">2nd District</th>
								</tr>
							</template>
							<tr>
								<td>{{item.province}}</td>
								<td class="with-input"><currency_input v-model="item.actual_year_1"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.actual_year_2"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.growth_rate"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.projection_year_1"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.projection_year_2"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.projection_year_3"></currency_input></td>
							</tr>
						</template>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row"  v-if="projected_populations.length <= 0">
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<form @submit.prevent="submitInfo">

							<p class="font-weight-bold">CREATE INFO FORM</p>
							<div class="form-group">
								<label>Year of Encoding</label>

						<select class="form-control" v-model="form.year_of_encoding">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
							</div>
							<div class="form-group">
								<label>Actual Year #1</label>

						<select class="form-control" v-model="form.actual_year_1">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select>
							</div>
							<div class="form-group">
								<label>Actual Year #2</label>
								<select class="form-control" v-model="form.actual_year_2">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
							<div class="form-group">
								<label>Projected Year #1</label>
								<select class="form-control" v-model="form.projection_year_1">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
							<div class="form-group">
								<label>Projected Year #2</label>

								<select class="form-control" v-model="form.projection_year_2">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
							<div class="form-group">
								<label>Projected Year #3</label>
								<select class="form-control" v-model="form.projection_year_3">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select>
							</div>
							<div class="form-group">
								<label>Growth Rate</label>
								<input type="text" class="form-control" v-model="form.growth_rate" readonly>
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
				year: new Date().getFullYear(),
				projected_populations: [],
				projected_population_infos: [],
				form: {
					actual_year_1: '',
					actual_year_2: '',
					growth_rate: '',
					projection_year_1: '',
					projection_year_2: '',
					projection_year_3: '',
					year_of_encoding: '',
				}
			}
		},
		methods: {
			submitInfo: function(){
				var vm = this;
				axios.post('/demograph/projected_populations/create', vm.form)
						.then(data => {
							vm.$toastr('success', 'Information is now added!', 'Projected Population by Province, MIMAROPA')

						});
			},
			getInfo: function(actual_year){
				var vm = this;
				axios.post('/demograph/projected_populations/get',{actual_year: actual_year} )
						.then(data => {
							vm.projected_populations = data.data.projected_populations;
							vm.projected_population_infos = data.data.projected_population_infos;

						});
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/demograph/projected_populations/update', {data: vm.projected_populations})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'Projected Population by Province, MIMAROPA')
						})
			}
		},
		watch: {
			year: function(val){
				if(val != "")
				{
					this.getInfo(val);
				}else{
					this.getInfo();
				}
			},
			form: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.form.growth_rate = val.actual_year_1 + " - " + val.actual_year_2;
				},
				deep: true,
			}
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		}
	}
</script>

