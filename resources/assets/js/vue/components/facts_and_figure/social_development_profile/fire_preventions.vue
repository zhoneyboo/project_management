<template>
	<div id="fire_preventions">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Fire Prevention</h4>
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
						<td class="text-right">{{item.no_of_fire_station_bfp}}</td>
						<td class="text-right">{{item.no_of_fire_station_lgu}}</td>
						<td class="text-right">{{item.no_of_fire_trucks_bfp}}</td>
						<td class="text-right">{{item.no_of_fire_trucks_lgu}}</td>
						<td class="text-right">{{item.no_of_fire_trucks_ngo}}</td>
						<td class="text-right">{{item.no_of_personnel}}</td>
					</tr>
				</template>
			</tbody>
		</table>
	</div>
</template>

<script>
	export default{
		props:["year"],
		data: function(){
			return {
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
	}
</script>