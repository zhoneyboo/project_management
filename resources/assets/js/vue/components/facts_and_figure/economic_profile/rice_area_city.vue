<template>
	<div id="rice_area_city">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Rice Area by City/Municipality ({{year}})</h4>
			</div>
		</div>
			<div class="row">
				<table class="table table-light table-bordered">
					<thead>
						<tr class="text-center">
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
								<td class="text-right">{{item.irrigated_area}}</td>
								<td class="text-right">{{item.rainfed_area}}</td>
								<td class="text-right">{{item.total_rice_area}}</td>
							</tr>
						</template>
					</tbody>
					<tfoot>
						<tr>
							<th>ORIENTAL MINDORO</th>
							<th class="text-right">
								<currency_label :data="total.irrigated_area"></currency_label>
							</th>
							<th class="text-right">
								<currency_label :data="total.rainfed_area"></currency_label>
							</th>
							<th class="text-right">
								<currency_label :data="total.total_rice_area"></currency_label>
							</th>
						</tr>
					</tfoot>
				</table>
			</div>
	</div>
</template>

<script>
	export default{
		props:["year"],
		data: function(){
			return {
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