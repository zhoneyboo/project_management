
<template>
	<div id="vegetable_production">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">VEGETABLE PRODUCTION BY CITY/MUNICIPALITY</h4>
			</div>
		</div>
			<table class="table table-bordered table-light">
				<thead>
					<tr>
						<th>City/Municipality</th>
						<th>Area Harvested</th>
						<th>Production (MT)</th>
						<th>Average Yield</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="item in vegetable_production">
						<tr>
							<td>{{item.commodity}}</td>
							<td class="text-right">{{item.area_harvested}}</td>
							<td class="text-right">{{item.production_mt}}</td>
							<td class="text-right">{{item.arerage_yield}}</td>
						</tr>
					</template>
				</tbody>
				<tfoot>
					<tr>
						<th>Total</th>
						<th class="text-right">{{total.area_harvested.toFixed(2)}}</th>
						<th class="text-right">{{total.production_mt.toFixed(2)}}</th>
						<th class="text-right">{{total.arerage_yield.toFixed(2)}}</th>
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
				vegetable_production: [],
				total: {
					area_harvested: 0,
					production_mt: 0,
					arerage_yield: 0,
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
				axios.post('/economic_profile/vegetable_production/get', {year: year})
						.then(data => {
							vm.vegetable_production = data.data;
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
			vegetable_production: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total.area_harvested = 0;
					vm.total.production_mt = 0;
					vm.total.arerage_yield = 0;
					for (var i = 0; i < val.length; i++) {
						vm.total.area_harvested += parseFloat(val[i].area_harvested);
						vm.total.production_mt += parseFloat(val[i].production_mt);
						vm.total.arerage_yield += parseFloat(val[i].arerage_yield);
					}
				},
				deep: true
			}
		},
	}
</script>