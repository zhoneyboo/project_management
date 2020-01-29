<template>
	<div id="income_and_expenditures">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Income and Expenditures</h4>
			</div>
		</div>
		<table class="table table-light table-bordered">
			<thead>
				<tr>
					<th>Item</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>Income and Expenditures (GF, SEF, BLOM)</th>
					<td></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Income (General and Special Education Fund)</td>
					<td class="text-right"><currency_label :data="income_and_expenditure.income_general_fund"></currency_label></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Expenditures/Obligations</td>
					<td class="text-right"><currency_label :data="income_and_expenditure.expenditures_obligations"></currency_label></td>
				</tr>
				<tr>
					<th>Total Revenues by Source</th>
					<td></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tax Revenue/Special Education Tax</td>
					<td class="text-right"><currency_label :data="income_and_expenditure.tax_revenue"></currency_label></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Permit and Licenses</td>
					<td class="text-right"><currency_label :data="income_and_expenditure.permit_and_license"></currency_label></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Service Income</td>
					<td class="text-right"><currency_label :data="income_and_expenditure.service_income"></currency_label></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Business Income</td>
					<td class="text-right"><currency_label :data="income_and_expenditure.business_income"></currency_label></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Other Income (Interest Income, IRA, Misc. Income)</td>
					<td class="text-right"><currency_label :data="income_and_expenditure.other_income"></currency_label></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Income from Grants and Donations</td>
					<td class="text-right"><currency_label :data="income_and_expenditure.grants_and_donation"></currency_label></td>
				</tr>
				<tr>
					<th>Total Expenditures by Object – GF and SEF </th>
					<td></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Personal Services</td>
					<td class="text-right"><currency_label :data="income_and_expenditure.personal_services"></currency_label></td>
				</tr>

				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MOOE</td>
					<td class="text-right"><currency_label :data="income_and_expenditure.mooe"></currency_label></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Capital Outlays</td>
					<td class="text-right"><currency_label :data="income_and_expenditure.capitals_outlays"></currency_label></td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
<script>
	export default{
		props: ["year"],
		data: function(){
			return{
				income_and_expenditure: {
					income_general_fund: 0,
					expenditures_obligations: 0,
					tax_revenue: 0,
					permit_and_license: 0,
					service_income: 0,
					business_income: 0,
					other_income: 0,
					grants_and_donation: 0,
					personal_services: 0,
					mooe: 0,
					capitals_outlays: 0,
				}

			}
		},
		watch: {
			year:function(val){
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
		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/financial_profile/income_and_expenditure/get', {year: year})
						.then(data => {
							vm.income_and_expenditure = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/financial_profile/income_and_expenditure/update', vm.income_and_expenditure)
					.then(data => {
						console.log(data.data)
					})
			}
		},
		mounted:function(){
			this.getInfo()
		}
	}
</script>