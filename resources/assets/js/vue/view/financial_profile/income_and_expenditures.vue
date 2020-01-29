<template>
	<div id="income_and_expenditures">
		<div class="container">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Income and Expenditures</h5>
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
						<td class="with-input"><currency_input   v-model="income_and_expenditure.income_general_fund"></currency_input></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Expenditures/Obligations</td>
						<td class="with-input"><currency_input  v-model="income_and_expenditure.expenditures_obligations"></currency_input></td>
					</tr>
					<tr>
						<th>Total Revenues by Source</th>
						<td></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tax Revenue/Special Education Tax</td>
						<td class="with-input"><currency_input  v-model="income_and_expenditure.tax_revenue"></currency_input></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Permit and Licenses</td>
						<td class="with-input"><currency_input  v-model="income_and_expenditure.permit_and_license"></currency_input></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Service Income</td>
						<td class="with-input"><currency_input v-model="income_and_expenditure.service_income"></currency_input></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Business Income</td>
						<td class="with-input"><currency_input  v-model="income_and_expenditure.business_income"></currency_input></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Other Income (Interest Income, IRA, Misc. Income)</td>
						<td class="with-input"><currency_input  v-model="income_and_expenditure.other_income"></currency_input></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Income from Grants and Donations</td>
						<td class="with-input"><currency_input  v-model="income_and_expenditure.grants_and_donation"></currency_input></td>
					</tr>
					<tr>
						<th>Total Expenditures by Object – GF and SEF </th>
						<td></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Personal Services</td>
						<td class="with-input"><currency_input  v-model="income_and_expenditure.personal_services"></currency_input></td>
					</tr>

					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MOOE</td>
						<td class="with-input"><currency_input v-model="income_and_expenditure.mooe"></currency_input></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Capital Outlays</td>
						<td class="with-input"><currency_input v-model="income_and_expenditure.capitals_outlays"></currency_input></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>
<script>
	export default{
		data: function(){
			return{
				year: new Date().getFullYear(),
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
						vm.$toastr('success', 'Information is now updated!', 'Income and Expenditure')
					})
			}
		},
		mounted:function(){
			this.getInfo()
		}
	}
</script>