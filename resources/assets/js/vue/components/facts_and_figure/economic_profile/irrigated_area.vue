<template>
	<div id="irrigated_area">
			<div class="card bg-info">
				<div class="card-body pl-3 pr-3 pt-2 pb-2">
					<h4 class="font-weight-bold text-uppercase text-white">IRRIGATED AREA BY TYPE</h4>
				</div>
			</div>
			<div class="row">
				<table class="table table-light table-bordered">
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
								<td colspan="5">1st District</td>
							</tr>
							<tr v-if="item.municipality == 9">
								<td colspan="5">2nd District</td>
							</tr>
							<tr>
								<td>{{item.municipality_name}}</td>
								<td class="text-right">{{item.ris}}</td>
								<td class="text-right">{{item.cis}}</td>
								<td class="text-right">{{item.pump}}</td>
								<td class="text-right"><currency_label :data="item.total"></currency_label></td>
							</tr>
						</template>
					</tbody>
					<tfoot>
						<tr>
							<th class="text-right">ORIENTAL MINDORO</th>
							<th class="text-right"><currency_label :data="total.ris"></currency_label></th>
							<th class="text-right"><currency_label :data="total.cis"></currency_label></th>
							<th class="text-right"><currency_label :data="total.pump"></currency_label></th>
							<th class="text-right">
								<currency_label :data="parseFloat(total.ris) +
									parseFloat(total.cis) +
									parseFloat(total.pump)"></currency_label>
							</th>
						</tr>
					</tfoot>
				</table>
			</div>
	</div>
</template>

<script>
	export default{
		props: ["year"],
		data: function(){
			return {
				irrigated_area: [],

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