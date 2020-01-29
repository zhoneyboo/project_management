<template>
	<div id="irrigated_area">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">IRRIGATED AREA BY TYPE</h5>
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
				<table class="table table-light table-bordered mt-1">
					<thead>
						<tr>
							<th>City/Municipality</th>
							<th>RIS (ha)</th>
							<th>CIS (ha)</th>
							<th>Pump/STW(ha)</th>
							<th>Total (ha)</th>
						</tr>
					</thead>
					<tbody>
						<template v-for="item in irrigated_area">
							<tr v-if="item.municipality == 1">
								<td colspan="4">1st District</td>
							</tr>
							<tr v-if="item.municipality == 9">
								<td colspan="4">2nd District</td>
							</tr>
							<tr>
								<td>{{item.municipality_name}}</td>
								<td class="with-input">
									<currency_input v-model="item.ris"></currency_input>
								</td>
								<td class="with-input">
									<currency_input v-model="item.cis"></currency_input>
								</td>
								<td class="with-input">
									<currency_input v-model="item.pump"></currency_input>
								</td>
								<td>
									<currency_label :data="item.total.toFixed(2)"></currency_label>
								</td>
							</tr>
						</template>
					</tbody>
					<tfoot>
						<tr>
							<th>ORIENTAL MINDORO</th>
							<th>
								<currency_label :data="total.ris.toFixed(2)"></currency_label>
							</th>
							<th>
								<currency_label :data="total.cis.toFixed(2)"></currency_label>
							</th>
							<th>
								<currency_label :data="total.pump.toFixed(2)"></currency_label>
							</th>
							<th>
								<currency_label :data="(parseFloat(total.ris) +
								parseFloat(total.cis) +
								parseFloat(total.pump)).toFixed(2)"></currency_label>
							</th>
						</tr>
					</tfoot>
				</table>
	</div>
</template>

<script>
	export default{
		data: function(){
			return {
				irrigated_area: [],
				year: new Date().getFullYear(),
				total: {
					ris: 0,
					cis: 0,
					pump: 0,
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
				axios.post('/economic_profile/irrigated_area/get', {year:year})
						.then(data => {
							vm.irrigated_area = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/economic_profile/irrigated_area/update', {data:vm.irrigated_area})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'IRRIGATED AREA BY TYPE')
						})
			}
		},
		watch: {
			irrigated_area: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total.ris = 0;
					vm.total.cis = 0;
					vm.total.pump = 0;

					var irrigated_area = vm.irrigated_area;
					for (var i = val.length - 1; i >= 0; i--) {
						irrigated_area[i].total = parseFloat(val[i].ris) + parseFloat(val[i].cis) + parseFloat(val[i].pump)
						vm.total.ris += parseFloat(val[i].ris);
						vm.total.cis += parseFloat(val[i].cis);
						vm.total.pump += parseFloat(val[i].pump);
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