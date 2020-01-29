
<template>
	<div id="energized_and_unenergized_barangay_sitios">
		
			<div class="card bg-info">
				<div class="card-body pl-3 pr-3 pt-2 pb-2">
					<h4 class="font-weight-bold text-uppercase text-white">Energized and Unenergized Barangay and Sitios in Oriental Mindoro</h4>
				</div>
			</div>
			<table class="table table-bordered table-light">
				<thead>
					<tr>
						<th>City/Municipality</th>
						<th>Potential</th>
						<th>Energized</th>
						<th>Percent</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="item in energized_and_unenergized_barangay_sitios">
						<tr v-if="item.municipality == 1" class="bg-secondary text-white">
							<td colspan="9">1st District</td>
						</tr>
						<tr v-if="item.municipality == 9" class="bg-secondary text-white">
							<td colspan="9">2nd District</td>
						</tr>
						<tr>
							<td>{{item.municipality_name}}</td>
							<td class="text-right">{{item.potential}}</td>
							<td class="text-right">{{item.energized}}</td>
							<td class="text-right">
								<span>{{item.barangay_percent.toFixed(2)}} %</span>
							</td>
						</tr>
					</template>
				</tbody>
				<tfoot>
					<tr>
						<th>Oriental Mindoro</th>
						<th class="text-right">{{total.potential}}</th>
						<th class="text-right">{{total.energized}}</th>
						<th class="text-right">{{total.percent.toFixed(2)}} %</th>
					</tr>
				</tfoot>
			</table>
	</div>
</template>

<script>
	export default{
		data: function(){
			return {
				year: '',
				energized_and_unenergized_barangay_sitios: [],
				total: {
					potential: 0,
					energized: 0,
					percent: 0,
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
				axios.post('/infrustructure_and_utilities/energized_and_unenergized_barangay_sitios/get', {year: year})
						.then(data => {
							vm.energized_and_unenergized_barangay_sitios = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/infrustructure_and_utilities/energized_and_unenergized_barangay_sitios/update', {data: vm.energized_and_unenergized_barangay_sitios})
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
			energized_and_unenergized_barangay_sitios:{
				handler: function(val)
				{
					var vm = this;
					vm.total.potential = 0;
					vm.total.energized = 0;
					vm.total.percent = 0;
					for (var i = val.length - 1; i >= 0; i--) {

						var barangay_percent = (parseFloat(val[i]["energized"]) / parseFloat(val[i]["potential"])) * 100;

						if(isNaN(barangay_percent))
						{
							barangay_percent = 0;
						}
						val[i]["barangay_percent"] = barangay_percent ;
						vm.total.potential += parseFloat(val[i].potential);
						vm.total.energized += parseFloat(val[i].energized);
					}
					vm.total.percent = (parseFloat(vm.total.energized) / parseFloat(vm.total.potential)) *100
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