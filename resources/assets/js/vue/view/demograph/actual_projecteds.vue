<template>
	<div id="actual_projected_infos">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Actual and Projected Population and Number of Households, Growth Rate by City/Municipality</h5>
			</div>
		</div>

		<div class="row mt-1">
			<div class="col-md">
				<div class="container">
					<div class="row align-items-middle">
						<div class="col-4 col-md-3 col-lg-2 col-xl-2 ml-auto pr-1">
							<div class="form-group m-0">
								<select class="form-control" v-model="year">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in webYear" :value="item.actual_year">{{item.old_year}} - {{item.actual_year}}</option>
								</select>
								<!-- <v-select  v-model="year" :options="defaultYear"> -->
								<!-- </v-select> -->
							</div>
						</div>
						<div class="col-auto d-flex align-items-end p-0">
							<div class="col">
								<button class="btn btn-info" @click="updateInfo" v-if="actual_projecteds.length > 0">Update</button>

								<button class="btn btn-info" @click="resetYear">NEW</button>
							</div>
						</div>
					</div>
				</div>

				<table class="table table-light table-bordered mt-1">
					<thead class="text-center">
						<tr>
							<th class="align-middle" rowspan="2">Municipality</th>
							<th class="align-middle" colspan="2">{{actual_projected_infos.old_year}}</th>
							<th class="align-middle" colspan="2">{{actual_projected_infos.actual_year}} (Actual)</th>
							<th class="align-middle" colspan="2">{{actual_projected_infos.projected_year}} (Projected)</th>
							<th class="align-middle" colspan="2">Growth Rate</th>
						</tr>
						<tr>
							<th class="align-middle">Total Pop'n</th>
							<th class="align-middle">No. of HHs</th>
							<th class="align-middle">Total Pop'n</th>
							<th class="align-middle">No. of HHs</th>
							<th class="align-middle">Total Pop'n</th>
							<th class="align-middle">No. of HHs</th>
							<th class="align-middle">{{actual_projected_infos.growth_rate_1}}</th>
							<th class="align-middle">{{actual_projected_infos.growth_rate_2}}</th>
						</tr>
					</thead>
					<tbody>
						<template v-if="actual_projecteds.length <= 0">
							<tr>
								<td colspan="9">No year selected</td>
							</tr>
						</template>
						<template v-for="item in actual_projecteds">
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
								<td class="with-input"><currency_input v-model="item.old_year_pop"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.old_year_hh"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.actual_year_pop"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.actual_year_hh"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.projected_year_pop"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.projected_year_hh"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.growth_rate_1"></currency_input></td>
								<td class="with-input"><currency_input v-model="item.growth_rate_2"></currency_input></td>
							</tr>
						</template>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row"  v-if="actual_projecteds.length <= 0">
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<form @submit.prevent="submitInfo">
							<p class="font-weight-bold">CREATE INFO FORM</p>
							<div class="form-group">
								<label>Previous Year</label>
								<v-select  v-model="form.old_year" :options="defaultYear"></v-select>

							<!-- 	<select class="form-control" v-model="form.old_year">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select> -->
							</div>
							<div class="form-group">
								<label>Actual Year</label>
								<v-select  v-model="form.actual_year" :options="defaultYear"></v-select>

								<!-- <select class="form-control" v-model="form.actual_year">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select> -->
							</div>
							<div class="form-group">
								<label>Projected Year</label>
								<v-select  v-model="form.projected_year" :options="defaultYear"></v-select>
								
							</div>
							<div class="form-group">
								<label>Growth Rate</label>
								<div class="row">
									<div class="col-md">
										<input type="text" class="form-control" placeholder="Range 1" v-model="form.growth_rate_1">
									</div>
									<div class="col-md">
										<input type="text" class="form-control" placeholder="Range 2" v-model="form.growth_rate_2">
									</div>
								</div>
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
				actual_projecteds: [],
				actual_projected_infos: [],
				form: {
					old_year: '',
					actual_year: '',
					projected_year: '',
					growth_rate_1: '',
					growth_rate_2: '',
				},
				webYear: [],
			}
		},
		methods: {
			submitInfo: function(){
				var vm = this;
				axios.post('/demograph/actual_projecteds/create', vm.form)
						.then(data => {
							vm.$toastr('success', 'Information is now added!', 'Actual and Projected Population and Number of Households, Growth Rate by City/Municipality')
							vm.getYear();
						});
			},
			resetYear: function()
			{
				this.year = "";
			},
			getInfo: function(actual_year){
				var vm = this;
				axios.post('/demograph/actual_projecteds/get',{actual_year: actual_year} )
						.then(data => {
							vm.actual_projecteds = data.data.actual_projected;
							vm.actual_projected_infos = data.data.actual_projected_infos;
							vm.getYear();

						});
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/demograph/actual_projecteds/update', {data: vm.actual_projecteds})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'Actual and Projected Population and Number of Households, Growth Rate by City/Municipality')
							vm.getYear();
						})
			},
			getYear: function(){
				var vm = this;
				axios.post('/demograph/actual_projecteds/getYear')
						.then(data => {
							vm.webYear = data.data;
						})
			}
		},
		watch: {
			year: function(val){
				if(val != "")
				{
					this.getInfo(val);
					this.getYear();
				}else{
					this.getInfo();
					this.getYear();
				}
			}
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		mounted: function(){
			this.getYear();
		}
	}
</script>

