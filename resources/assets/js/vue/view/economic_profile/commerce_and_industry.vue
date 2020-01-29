<template>
	<div id="commerce_and_industry">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">COMMERCE AND INDUSTRY</h5>
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
			<table class="table table-light table-bordered  mt-1">
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
							<td class="with-input">
								<currency_input v-model="item.no_of_applications"></currency_input>
							</td>
							<td class="with-input">
								<currency_input v-model="item.investments"></currency_input>
							</td>
							<td class="with-input">
								<currency_input v-model="item.employment"></currency_input>
							</td>
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
		data: function(){
			return {
				year: new Date().getFullYear(),
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
			updateInfo: function(){
				var vm = this;
				axios.post('/economic_profile/commerce_and_industry/update', {data: vm.commerce_and_industry})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'COMMERCE AND INDUSTRY')
						})
			}
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