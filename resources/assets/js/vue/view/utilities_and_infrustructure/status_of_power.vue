<template>
	<div id="status_of_power">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Status of Electrification</h5>
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
			<table class="table table-bordered table-light">
				<thead>
					<tr>
						<th rowspan="2">City/Municipality</th>
						<th colspan="3">Barangays</th>
						<th colspan="3">Sitios</th>
						<th rowspan="2">House Connections</th>
						<th rowspan="2">Members Approved</th>
					</tr>
					<tr>
						<th>Covered</th>
						<th>Energized</th>
						<th>%</th>

						<th>Energized</th>
						<th>%</th>
						<th>Unenergized</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="item in status_of_power">
						<tr v-if="item.municipality == 1" class="bg-secondary text-white">
							<td colspan="9">1st District</td>
						</tr>
						<tr v-if="item.municipality == 9" class="bg-secondary text-white">
							<td colspan="9">2nd District</td>
						</tr>
						<tr>
							<td>{{item.municipality_name}}</td>
							<td width="15%" class="with-input">
								<currency_input v-model="item.barangay_covered"></currency_input>
							</td>
							<td width="15%" class="with-input">
								<currency_input v-model="item.barangay_energized"></currency_input>
							</td>
							<td width="15%" class="text-right">
								<span>{{item.barangay_percent.toFixed(2)}} %</span>
							</td>
							<td width="15%" class="with-input">
								<currency_input v-model="item.sitios_energized"></currency_input>
							</td>
							<td  width="15%"class="text-right">
								<span>{{item.sitio_percent.toFixed(2)}} %</span>
							</td>
							<td width="15%" class="with-input">
								<currency_input v-model="item.sitios_unerginized"></currency_input>
							</td>
							<td width="15%" class="with-input">
								<currency_input v-model="item.house_connections"></currency_input>
							</td>
							<td width="15%" class="with-input">
								<currency_input v-model="item.members_approved"></currency_input>
							</td>
						</tr>
					</template>
				</tbody>
				<tfoot>
					<tr>
						<th>Oriental Mindoro</th>
						<th>{{total.barangay_covered.toFixed(2)}}</th>
						<th>{{total.barangay_energized.toFixed(2)}}</th>
						<th>{{total.barangay_percent.toFixed(2)}}</th>
						<th>{{total.sitios_energized.toFixed(2)}}</th>
						<th>{{total.sitio_percent.toFixed(2)}}</th>
						<th>{{total.sitios_unerginized.toFixed(2)}}</th>
						<th>{{total.house_connections.toFixed(2)}}</th>
						<th>{{total.members_approved.toFixed(2)}}</th>
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
				status_of_power: [],
				total: {
					barangay_covered: 0,
					barangay_energized: 0,
					sitios_energized: 0,
					sitios_unerginized: 0,
					house_connections: 0,
					members_approved: 0,
					barangay_percent: 0,
					sitio_percent: 0,
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
				axios.post('/infrustructure_and_utilities/status_of_power/get', {year: year})
						.then(data => {
							vm.status_of_power = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/infrustructure_and_utilities/status_of_power/update', {data: vm.status_of_power})
					.then(data => {
						vm.$toastr('success', 'Information is now updated!', 'Status of Power')
					})
			}
		},
		watch: {
			year: function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			},
			status_of_power:{
				handler: function(val)
				{
					var vm = this;
					vm.total.barangay_covered = 0;
					vm.total.barangay_energized = 0;
					vm.total.sitios_energized = 0;
					vm.total.sitios_unerginized = 0;
					vm.total.house_connections = 0;
					vm.total.members_approved = 0;
					vm.total.barangay_percent = 0;
					vm.total.sitio_percent = 0;
					for (var i = val.length - 1; i >= 0; i--) {

						var barangay_percent = (parseFloat(val[i]["barangay_energized"]) / parseFloat(val[i]["barangay_covered"])) * 100;

						var sitio_percent = (parseFloat(val[i]["sitios_energized"]) / (parseFloat(val[i]["sitios_energized"]) + parseFloat(val[i]["sitios_unerginized"]))) * 100;

						if(isNaN(barangay_percent))
						{
							barangay_percent = 0;
						}
						if(isNaN(sitio_percent))
						{
							sitio_percent = 0;
						}


						val[i]["sitio_percent"] = sitio_percent ;
						val[i]["barangay_percent"] = barangay_percent ;

						vm.total.barangay_covered += parseFloat(val[i].barangay_covered);
						vm.total.barangay_energized += parseFloat(val[i].barangay_energized);
						vm.total.sitios_energized += parseFloat(val[i].sitios_energized);
						vm.total.sitios_unerginized += parseFloat(val[i].sitios_unerginized);
						vm.total.house_connections += parseFloat(val[i].house_connections);
						vm.total.members_approved += parseFloat(val[i].members_approved);
						
					}

					vm.total.barangay_percent = (vm.total.barangay_covered / vm.total.barangay_energized) * 100;
					vm.total.sitio_percent = (vm.total.sitios_energized / vm.total.sitios_unerginized) * 100;
				},
				deep: true
			}
		},

		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},

	}
</script>