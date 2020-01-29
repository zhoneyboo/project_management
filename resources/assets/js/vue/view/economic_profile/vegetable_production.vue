
<template>
	<div id="vegetable_production">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">VEGETABLE PRODUCTION BY CITY/MUNICIPALITY</h5>
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
			<table class="table table-bordered table-light  mt-1">
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
							<td class="with-input">
								<currency_input v-model="item.area_harvested"></currency_input>
							</td>
							<td class="with-input">
								<currency_input v-model="item.production_mt"></currency_input>
							</td>
							<td class="with-input">
								<currency_input v-model="item.arerage_yield"></currency_input>
							</td>
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
		data: function(){
			return {
				year: new Date().getFullYear(),
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
			updateInfo: function(){
				var vm = this;
				axios.post('/economic_profile/vegetable_production/update', {data: vm.vegetable_production})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'VEGETABLE PRODUCTION BY CITY/MUNICIPALITY')
						})
			}
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

		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},

	}
</script>