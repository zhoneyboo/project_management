<template>
	<div id="annual_income_budget">
		<div class="container">

			
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Income classification of City/Municipality</h5>
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

			<table class="table table-bordered table-light mt-1">
				<thead>
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
							<td class="with-input">
								<currency_input v-model="data.income"></currency_input>
							</td>
							<td class="with-input">
								<currency_input v-model="data.budget"></currency_input>
							</td>
						</tr>
					</template>
				</tbody>
				<tfoot>
					<tr>
						<th>Total</th>
						<th>{{total_income.toFixed(2)}}</th>
						<th>{{total_budget.toFixed(2)}}</th>
					</tr>
				</tfoot>
			</table>
		</div>

	</div>
</template>

<script>
	export default{
		data:function(){
			return {
				annual_income_budget: [],
				year: new Date().getFullYear(),
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
							vm.$toastr('success', 'Information is now create!', 'Income classification of City/Municipality')
						})
			}
		}
	}
</script>