<template>
	<div id="status_of_power">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Status of Electrification</h4>
			</div>
		</div>
		<table class="table table-bordered table-light">
			<thead class="text-center">
				<tr>
					<th class="align-middle" rowspan="2">City/Municipality</th>
					<th class="align-middle" colspan="3">Barangays</th>
					<th class="align-middle" colspan="3">Sitios</th>
					<th class="align-middle" rowspan="2">House Connections</th>
					<th class="align-middle" rowspan="2">Members Approved</th>
				</tr>
				<tr>
					<th class="align-middle">Covered</th>
					<th class="align-middle">Energized</th>
					<th class="align-middle">%</th>

					<th class="align-middle">Energized</th>
					<th class="align-middle">%</th>
					<th class="align-middle">Unenergized</th>
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
						<td class="text-right">{{item.barangay_covered}}</td>
						<td class="text-right">{{item.barangay_energized}}</td>
						<td class="text-right">
							<span>{{item.barangay_percent.toFixed(2)}} %</span>
						</td>
						<td class="text-right">{{item.sitios_energized}}</td>
						<td class="text-right">
							<span>{{item.sitio_percent.toFixed(2)}} %</span>
						</td>
						<td class="text-right">{{item.sitios_unerginized}}</td>
						<td class="text-right">{{item.house_connections}}</td>
						<td class="text-right">{{item.members_approved}}</td>
					</tr>
				</template>
			</tbody>
			<tfoot>
				<tr>
					<th>Oriental Mindoro</th>
					<th class="text-right">{{total.barangay_covered.toFixed(2)}}</th>
					<th class="text-right">{{total.barangay_energized.toFixed(2)}}</th>
					<th class="text-right">{{total.barangay_percent.toFixed(2)}} %</th>
					<th class="text-right">{{total.sitios_energized.toFixed(2)}}</th>
					<th class="text-right">{{total.sitio_percent.toFixed(2)}} %</th>
					<th class="text-right">{{total.sitios_unerginized.toFixed(2)}}</th>
					<th class="text-right">{{total.house_connections.toFixed(2)}}</th>
					<th class="text-right">{{total.members_approved.toFixed(2)}}</th>
				</tr>
			</tfoot>
		</table>
	</div>
</template>

<script>
	export default{
		props: ["year"],
		data: function(){
			return {
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
							console.log(data.data)
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