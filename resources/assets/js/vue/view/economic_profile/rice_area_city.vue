<template>
	<div id="rice_area_city">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">RICE AREA CITY/MUNICIPALITY</h5>
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
						<button class="btn btn-primary" @click="updateInfo">Update</button>
					</div>
				</div>
			</div>
				<table class="table table-light table-bordered  mt-1">
					<thead>
						<tr>
							<th>City/Municipality</th>
							<th>Irrigated Area (ha)</th>
							<th>Reinfed Area (ha)</th>
							<th>Total Rice Area (ha)</th>
						</tr>
					</thead>
					<tbody>
						<template v-for="item in rice_area_city">
							<tr v-if="item.municipality == 1">
								<td colspan="4">1st District</td>
							</tr>
							<tr v-if="item.municipality == 9">
								<td colspan="4">2nd District</td>
							</tr>
							<tr>
								<td >{{item.municipality_name}}</td>
								<td class="with-input">
									<currency_input v-model="item.irrigated_area"></currency_input>
								</td>
								<td class="with-input">
									<currency_input v-model="item.rainfed_area"></currency_input>
								</td>
								<td class="with-input">
									<currency_input v-model="item.total_rice_area"></currency_input>
								</td>
							</tr>
						</template>
					</tbody>
					<tfoot>
						<tr>
							<th>ORIENTAL MINDORO</th>
							<th class="text-right">
								<currency_label :data="total.irrigated_area"></currency_label>
							<th class="text-right">
								<currency_label :data="total.rainfed_area"></currency_label>
							</th>
								<currency_label :data="total.total_rice_area"></currency_label>
						</tr>
					</tfoot>
				</table>
	</div>
</template>

<script>
	export default{
		data: function(){
			return {
				year: new Date().getFullYear(),
				rice_area_city: [],
				total: {
					irrigated_area: 0,
					rainfed_area: 0,
					total_rice_area: 0,
				}
			}
		},
		mounted:function(){
			this.getInfo();
		},
		methods: {
			getInfo: function(year)
			{
				var vm = this;
				axios.post('/economic_profile/rice_area_by_city/get', {year: year})
						.then(data => {
							vm.rice_area_city = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/economic_profile/rice_area_by_city/update', {data: vm.rice_area_city})
					.then(data => {
						vm.$toastr('success', 'Information is now updated!', 'RICE AREA CITY/MUNICIPALITY')
					})
			}
		},
		watch: {
			rice_area_city: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total.irrigated_area = 0;
					vm.total.rainfed_area = 0;
					vm.total.total_rice_area = 0;

					for (var i = 0; i < val.length; i++) {
						vm.total.irrigated_area += parseFloat(val[i]['irrigated_area']);
						vm.total.rainfed_area += parseFloat(val[i]['rainfed_area']);
						vm.total.total_rice_area += parseFloat(val[i]['total_rice_area']);
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

	}
</script>