<template>
	<div id="high_value_commercial_crops">
			<div class="card bg-info">
				<div class="card-body pl-3 pr-3 pt-2 pb-2">
					<h4 class="font-weight-bold text-uppercase text-white">High Value Commercial Crops (HVCC) Production</h4>
				</div>
			</div>
			<table class="table table-bordered table-light mt-1">
				<thead>
					<tr>
						<th>Commodity</th>
						<th>Farmers Served</th>
						<th>No. of Trees Planted</th>
						<th>Area Planted (ha)</th>
						<th>Production (MT)</th>
						<th>Average Yield (MT/ha)</th>
					</tr>
				</thead>
				<tbody>
					<template v-if="high_value_commercial_crops.length <= 0">
						<tr>
							<td colspan="7" class="text-center">No item found</td>
						</tr>
					</template>
					<template v-for="item in high_value_commercial_crops">
						<tr>
							<td>{{item.commodity}}</td>
							<td class="text-right">
								<currency_label :data="item.farmers_served"></currency_label>
							</td>
							<td class="text-right"><currency_label 
								:data="item.no_of_trees_planted"></currency_label>
							</td>
							<td class="text-right">
								<currency_label :data="item.planted_area"></currency_label>
							</td>
							<td class="text-right">
								<currency_label :data="item.production"></currency_label>
							</td>
							<td class="text-right">
								<currency_label :data="item.average_yield"></currency_label>
							</td>
						</tr>
					</template>
				</tbody>
				<tfoot>
					<tr>
						<th>TOTAL</th>
						<th class="text-right">
							<currency_label :data="total.farmers_served"></currency_label>
						</th>
						<th class="text-right"><currency_label 
							:data="total.no_of_trees_planted"></currency_label>
						</th>
						<th class="text-right">
							<currency_label :data="total.planted_area"></currency_label>
						</th>
						<th class="text-right">
							<currency_label :data="total.production"></currency_label>
						</th>
						<th class="text-right">
							<currency_label :data="total.average_yield"></currency_label>
						</th>
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
				high_value_commercial_crops: [],
				total: {
					farmers_served: 0,
					no_of_trees_planted: 0,
					planted_area: 0,
					production: 0,
					average_yield: 0,
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
				axios.post('/economic_profile/high_value_commercial_crops/get', {year: year})
						.then(data => {
							vm.high_value_commercial_crops = data.data;
						})
			},
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
			high_value_commercial_crops: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total.farmers_served = 0;
					vm.total.no_of_trees_planted = 0;
					vm.total.planted_area = 0;
					vm.total.production = 0;
					vm.total.average_yield = 0;

					for (var i = 0; i < val.length; i++) {
						vm.total.farmers_served += parseFloat(val[i].farmers_served);
						vm.total.no_of_trees_planted += parseFloat(val[i].no_of_trees_planted);
						vm.total.planted_area += parseFloat(val[i].planted_area);
						vm.total.production += parseFloat(val[i].production);
						vm.total.average_yield += parseFloat(val[i].average_yield);
					}
				},
				deep: true
			}
		},

	}
</script>