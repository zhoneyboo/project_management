<template>
	<div id="commerce_and_industry">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">COMMERCE AND INDUSTRY</h4>
				<h5>Business Establishments by Type, Investments & Employement</h5>
			</div>
		</div>
			<table class="table table-light table-bordered">
				<thead>
					<tr>
						<th>Sector Classification</th>
						<th>No. of Applications</th>
						<th>Investments (PhP Million)</th>
						<th>Employment</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="item in commerce_and_industry">
						<tr>
							<td>{{item.sectoral_classification}}</td>
							<td class="text-right">{{item.no_of_applications}}</td>
							<td class="text-right">{{item.investments}}</td>
							<td class="text-right">{{item.employment}}</td>
						</tr>
					</template>
				</tbody>
				<tfoot>
					<tr>
						<th>Total</th>
						<th class="text-right">
							<currency_label :data="total.no_of_applications"></currency_label>
						</th>
						<th class="text-right">
							<currency_label :data="total.investments"></currency_label>
						</th>
						<th class="text-right">
							<currency_label :data="total.employment"></currency_label>
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
				commerce_and_industry: [],
				total: {
					no_of_applications: 0,
					investments: 0,
					employment: 0,
				}
			}
		},
		methods:{
			getInfo:function(year){
				var vm = this;
				axios.post('/economic_profile/commerce_and_industry/get', {year: year})
						.then(data => {
							vm.commerce_and_industry = data.data;
						})
			},
		},
		mounted: function()
		{
			this.getInfo();
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
			commerce_and_industry: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total.no_of_applications = 0;
					vm.total.investments = 0;
					vm.total.employment = 0;

					for (var i = 0; i < val.length; i++) {
						vm.total.no_of_applications += parseFloat(val[i].no_of_applications);
						vm.total.investments += parseFloat(val[i].investments);
						vm.total.employment += parseFloat(val[i].employment);
					}
				},
				deep: true
			}
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		}
	}
</script>