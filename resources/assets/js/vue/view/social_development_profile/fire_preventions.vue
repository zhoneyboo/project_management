<template>
	<div id="fire_preventions">
		<div class="card rounded-0 bg-light mt-1 shadow-sm">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Fire Prevention</h5>
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
					<div class="col">
						<button class="btn btn-info" @click="updateInfo">Update</button>
					</div>
				</div>
			</div>
		</div>

		<table class="table table-bordered table-light">
			<thead>
				<tr>
					<th  class="text-center align-middle" rowspan="2">City/Muncipality</th>
					<th  class="text-center align-middle" colspan="2">No. of Fire Stations</th>
					<th  class="text-center align-middle" colspan="3">No. of Fire Trucks</th>
					<th  class="text-center align-middle" rowspan="2">No. Office Personnel</th>
				</tr>
				<tr>
					<th class="text-center align-middle" >BFP Owned</th>
					<th class="text-center align-middle" >LGU Owned</th>
					<th class="text-center align-middle" >BFP</th>
					<th class="text-center align-middle" >LGU</th>
					<th class="text-center align-middle" >NGO</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="item in fire_preventions">
					<tr>
						<td>{{item.municipality}}</td>
						<td width="12%" class="with-input">
							<currency_input v-model="item.no_of_fire_station_bfp"></currency_input>
						</td>
						<td width="12%" class="with-input">
							<currency_input v-model="item.no_of_fire_station_lgu"></currency_input>
						</td>
						<td width="12%" class="with-input">
							<currency_input v-model="item.no_of_fire_trucks_bfp"></currency_input>
						</td>
						<td width="12%" class="with-input">
							<currency_input v-model="item.no_of_fire_trucks_lgu"></currency_input>
						</td>
						<td width="12%" class="with-input">
							<currency_input v-model="item.no_of_fire_trucks_ngo"></currency_input>
						</td>
						<td width="12%" class="with-input">
							<currency_input v-model="item.no_of_personnel"></currency_input>
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
				fire_preventions: [],
			}
		},
		methods:{
			getInfo: function(year){
				var vm = this;
				axios.post('/social_development/fire_preventions/get', {year: year})
					.then(data => {
						vm.fire_preventions = data.data;
					})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/social_development/fire_preventions/update', {data: vm.fire_preventions})
					.then(data => {
						vm.$toastr('success', 'Information is now updated!', 'Fire Prevention')
					});
			}
		},
		mounted: function(){
			this.getInfo();
		},
		watch: {
			year: function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val)
				}
			}
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		}
	}
</script>