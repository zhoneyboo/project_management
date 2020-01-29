<template>
	<div id="rice_production">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">RICE PRODUCTION BY CITY/MUNICIPALITY</h5>
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
					<template v-for="item in rice_production">
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
			</table>
	</div>
</template>

<script>
	export default{
		data: function(){
			return {
				year: new Date().getFullYear(),
				rice_production: [],
			}
		},
		mounted:function(){
			this.getInfo();
		},
		methods: {
			getInfo: function(year)
			{
				var vm = this;
				axios.post('/economic_profile/rice_production/get', {year: year})
						.then(data => {
							vm.rice_production = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/economic_profile/rice_production/update', {data: vm.rice_production})
						.then(data => {
						vm.$toastr('success', 'Information is now updated!', 'RICE PRODUCTION BY CITY/MUNICIPALITY')
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
			}
		},

		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},

	}
</script>