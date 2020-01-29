<template>
	<div id="annual_income_budget">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Income classification of City/Municipality</h4>
			</div>
		</div>
		<table class="table table-bordered table-light mt-1">
			<thead class="text-center">
				<tr>
					<th>City/Municipality</th>
					<th>Income (Php)</th>
					<th>Budger (Php)</th>
				</tr>
				
			</thead>
			<tbody>
				<template v-for="data in annual_income_budget">
					<tr>
						<td>{{data.municipality}}</td>
						<td class="text-right">{{data.income}}</td>
						<td class="text-right">{{data.budget}}</td>
					</tr>
				</template>
			</tbody>
			<tfoot>
				<tr>
					<th>Total</th>
					<th class="text-right">{{total_income.toFixed(2)}}</th>
					<th class="text-right">{{total_budget.toFixed(2)}}</th>
				</tr>
			</tfoot>
		</table>
	</div>
</template>

<script>
	export default{
		data:function(){
			return {
				annual_income_budget: [],
				year: '',
				total_income: 0,
				total_budget: 0,
			}
		},
		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch: {
			year: function(val)
			{
				if(val == "")
				{
					this.getData();
				}else{
					this.getDataYear(val);
				}
			},
			annual_income_budget: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total_income = 0;
					vm.total_budget = 0;

					for (var i = 0; i < val.length; i++) {
						vm.total_income += parseFloat(val[i]["income"]);
						vm.total_budget += parseFloat(val[i]["budget"]);
					}
				},
				deep: true
			}
		},
		mounted:function(){
			this.getData();
		},
		methods:{
			getData:function(){
				var vm = this;
				axios.post('/financial_profile/annual_budget/get')
						.then(data => {
							vm.annual_income_budget = data.data;
						})
			},
			getDataYear:function(year){
				var vm = this;
				axios.post('/financial_profile/annual_budget/get', {year: year})
						.then(data => {
							vm.annual_income_budget = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/financial_profile/annual_budget/update', {data: vm.annual_income_budget})
						.then(data => {
							console.log(data);
						})
			}
		}
	}
</script>