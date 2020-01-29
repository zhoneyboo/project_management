<template>
	<div id="marine_protected_areas">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Coastal Resources (Marine Protected Areas)</h5>

					<small><b>Major Species Commonly Caught</b> - Tanigue, tambakol, malasugi, mamsa, lapu-lapu, galunggong, tuna, herrings, hasa-hasa, kalapato, caranx, dalagang-bukid, alumahan, bisugo, samaral, anchovies, sardines</small>

					<small><b>Minor Species other than Fish</b> - Tanigue, tambakol, malasugi, mamsa, lapu-lapu, galunggong, tuna, herrings, hasa-hasa, kalapato, caranx, dalagang-bukid, alumahan, bisugo, samaral, anchovies, sardines</small>
				</div>
			</div>


			<div class="container mt-1">
				<div class="row">
					<div class="col-4 col-md-3 col-lg-2 col-xl-2 ml-auto pr-1">
						<div class="form-group p-0 m-0">
							<span>Year: </span> 
							<v-select  v-model="year" :options="defaultYear"></v-select>
						<!-- 	<select class="form-control" v-model="year">
								<option value="" disabled selected>-- Select Year --</option>
								<option v-for="item in defaultYear" :value="item">{{item}}</option>
							</select> -->
							 
						</div>
					</div>
					<div class="col-auto d-flex align-items-end p-0">
						<button class="btn btn-primary" @click="updateInfo">Update</button>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md">
					<table class="table table-bordered table-light mt-2">
						<thead class="text-center">
							<tr>
								<th>City/Municipality</th>
								<th>Municipal Waters (has.)</th>
								<th>MPA (coral reef habitat) has.</th>
								<th>MPA Percentage Share (%)</th>
							</tr>
						</thead>
						<tbody>
							<template  v-for="data in marine_protected_areas">
								<tr v-if="data.municipality_id == 1" class="bg-secondary text-white">
									<td colspan="4">1st District </td>
								</tr>
								<tr v-if="data.municipality_id == 9" class="bg-secondary text-white">
									<td colspan="4">2nd District</td>
								</tr>

								<tr>
									<td>{{data.municipality}}</td>
									<td class="with-input">
										<currency_input v-model="data.municipal_water"></currency_input>
									</td>
									<td  class="with-input">
										<currency_input v-model="data.mpa"></currency_input>
									</td>
									<td  class="with-input">
										<currency_input v-model="data.mpa_percent"></currency_input>
									</td>
								</tr>
							</template>
						</tbody>
						<tfoot>
							<tr>
								<th>Oriental Mindoro</th>
								<th>{{total_municipal_water.toFixed(2)}}</th>
								<th>{{mpa_total.toFixed(2)}}</th>
								<th>{{mpa_percent_total.toFixed(2)}}</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
	</div>
</template>
<script>
	export default{
		data:function(){
			return {
				marine_protected_areas: [],
				total_municipal_water: 0,
				mpa_total: 0,
				mpa_percent_total: 0,
				year: new Date().getFullYear(),
			}
		},
		watch: {
			marine_protected_areas: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total_municipal_water = 0;
					vm.mpa_total = 0;
					vm.mpa_percent_total = 0;



					for (var i = val.length - 1; i >= 0; i--) {
						vm.total_municipal_water += parseFloat(val[i]["municipal_water"]);
						vm.mpa_total += parseFloat(val[i]["mpa"]);
						vm.mpa_percent_total += parseFloat(val[i]["mpa_percent"]);
					}
				},
				deep: true
			},
			year: function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			}
		},

		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		methods: {
			getInfo:function(year){
				var vm = this;

				axios.post('/coastal_resources/get', {year: year})
					.then(data => {
						vm.marine_protected_areas = data.data;
					})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/coastal_resources/update', {data: vm.marine_protected_areas})
					.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'Coastal Resources (Marine Protected Areas)')
					})
			}
		},
		mounted:function(){
			this.getInfo();
		}
	}
</script>