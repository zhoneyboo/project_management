<template>
	<div id="municipalities">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Land Area by City/Municipality</h5>
					<small><b>Source:</b> Department of Environment and Natural Resources</small>
				</div>
			</div>
			<div class="container mt-1">
				<div class="row">
					<div class="col-4 col-md-3 col-lg-2 col-xl-2 ml-auto pr-1">
						<div class="form-group">
							<span>Year: </span> 
							<v-select  v-model="year" :options="defaultYear"></v-select>
							<!-- <select class="form-control" v-model="year">
								<option value="" disabled selected>-- Select Year --</option>
								<option v-for="item in defaultYear" :value="item">{{item}}</option>
							</select> -->
						</div>
					</div>
					<div class="col-auto d-flex align-items-center">
						<button class="btn btn-primary" @click="updateLand">Update</button>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md">
					<table class="table table-bordered table-light mt-2">
						<thead class="text-center">
							<tr>
								<th>City/Municipality</th>
								<th>Land Area (sq. km.)</th>
								<th>% to Total</th>
							</tr>
						</thead>
						<tbody>
							<template  v-for="data in municipality">
								<tr>
									<td>{{data.municipality}}</td>
									<td class="with-input">
										<currency_input v-model="data.land_area"></currency_input>
									</td>
									<td class="text-right">
										{{checkNaN(data.percent)}}
									</td>
								</tr>
								<tr v-if="data.municipality_id == 8" class="bg-secondary text-white">
									<td>Total Land Area (1st District)</td>
									<td class="text-right">
										<h5>{{checkNaN(distArr.first.total)}}</h5>
									</td>
									<td class="text-right">
										<h5>{{checkNaN(distArr.first.percent)}}</h5>
									</td>
								</tr>
								<tr v-if="data.municipality_id == 15" class="bg-secondary text-white">
									<td>Total Land Area (2nd District)</td>
									<td class="text-right">
										<h5>{{checkNaN(distArr.second.total)}}</h5>
									</td>
									<td class="text-right">
										<h5>{{checkNaN(distArr.second.percent)}}</h5>
									</td>
								</tr>
							</template>
						</tbody>
					</table>
				</div>
			</div>
	</div>
</template>

<script>
	export default{
		data:function(){
			return {
				municipality: [],
				total: 0,
				year: new Date().getFullYear(),
				distArr: {
					first:{
						total: 0,
						percent: 0,
					},
					second: {
						total: 0,
						percent: 0,
					}
				}
			}
		},

		watch:{
			municipality:{
				handler: function(val, oldVal){
					var vm = this;
					var municipality = val;
					var total = 0;
					vm.distArr.first.total = 0;
					vm.distArr.second.total = 0;

					vm.distArr.first.percent = 0;
					vm.distArr.second.percent = 0;


					for (var i = municipality.length - 1; i >= 0; i--) {
						total += parseFloat(municipality[i].land_area);

						if(municipality[i].district == 1)
						{
							vm.distArr.first.total += parseFloat(municipality[i].land_area);
						}else if(municipality[i].district == 2)
						{
							vm.distArr.second.total += parseFloat(municipality[i].land_area);
						}
					}

					for (var c = municipality.length - 1; c >= 0; c--) {
						vm.municipality[c]["percent"] = (( parseFloat(municipality[c].land_area) / total )) * 100;

						if(municipality[c].district == 1)
						{
							vm.distArr.first.percent += parseFloat(vm.municipality[c]["percent"]);
						}else if(municipality[c].district == 2)
						{
							vm.distArr.second.percent += parseFloat(vm.municipality[c]["percent"]);
						}
					}

					vm.total = total;
					vm.$forceUpdate();
				},
				deep: true
			},

			year: function(val){
				if(val == "" || val == null)
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}

			}

		},


		mounted: function(){
			this.getInfo();
		},
		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/land_area_municipality/get', {year: year})
						.then(data => {
							vm.municipality = data.data;
							vm.$forceUpdate();
						})
			},
			updateLand:function(){
				var vm = this;

				axios.post('/land_area_municipality/update', {data: vm.municipality})
						.then(data => {
							vm.$toastr('success', 'Information is now update!', 'Land Area by City/Municipality')
						})
			},
			checkNaN: function(int){
				if(isNaN(int) || int == undefined || int == null)
				{
					return '0.00';
				}else{
					return int.toFixed(2);
				}
			},
		},

		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		
	}
</script>