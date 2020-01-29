<template>
	<div id="corn_production">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">CORN PRODUCTION BY CITY/MUNICIPALITY</h5>
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
						<th>No. of Farmers</th>
						<th>Area Harvested</th>
						<th>Production (MT)</th>
						<th>Average Yield</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="item in corn_production">
						<tr v-if="item.municipality == 1">
							<td colspan="4">1st District</td>
						</tr>
						<tr v-if="item.municipality == 9">
							<td colspan="4">2nd District</td>
						</tr>
						<tr>
							<td>{{item.municipality_name}}</td>
							<td class="with-input">
								<currency_input v-model="item.no_of_farmers"></currency_input>
							</td>
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
						<th></th>
						<th class="text-right">
							<currency_label :data="total.no_of_farmers"></currency_label>
						</th>
						<th class="text-right">
							<currency_label :data="total.area_harvested"></currency_label>
						</th>
						<th class="text-right">
							<currency_label :data="total.production_mt"></currency_label>
						</th>
						<th class="text-right">
							<currency_label :data="total.arerage_yield"></currency_label>
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
				corn_production: [],
				total: {
					no_of_farmers: 0,
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
				axios.post('/economic_profile/corn_production/get', {year: year})
						.then(data => {
							vm.corn_production = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/economic_profile/corn_production/update', {data: vm.corn_production})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'CORN PRODUCTION BY CITY/MUNICIPALITY')
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
			corn_production: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total.no_of_farmers = 0;
					vm.total.area_harvested = 0;
					vm.total.production_mt = 0;
					vm.total.arerage_yield = 0;

					for (var i = 0; i < val.length; i++) {
						vm.total.no_of_farmers += parseFloat(val[i].no_of_farmers);
						vm.total.area_harvested += parseFloat(val[i].area_harvested);
						vm.total.production_mt += parseFloat(val[i].production_mt);
						vm.total.arerage_yield += parseFloat(val[i].arerage_yield);
					}

				},
				deep: true,
			}
		},

		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			},
		},

	}
</script>