<template>
	<div id="health_facilities">
		
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Nutritional Status</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<table class="table table-light table-bordered mt-1">
					<thead>
						<tr>
							<th>Facilities</th>
							<th>Number</th>
						</tr>
					</thead>
					<tbody>
						<template v-for="item in health_facilities">
							<tr>
								<td>{{item.facility}}</td>
								<td class="text-right">{{item.number}}</td>
							</tr>
						</template>
					</tbody>
				</table>
			</div>
			<div class="col-md">
				<table class="table table-light table-bordered mt-1">
					<thead>
						<tr>
							<th>Practitioners (government)</th>
							<th>Number</th>
						</tr>
					</thead>
					<tbody>
						<template v-for="data in health_personnels">
							<tr>
								<td>{{data.personnel}}</td>
								<td class="text-right">{{data.number}}</td>
							</tr>
						</template>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		props: ["year"],
		data: function(){
			return {
				health_facilities: [],
				health_personnels: [],
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
		},
		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/social_development/health_facilities/get', {year: year})
						.then(data => {
							vm.health_facilities = data.data
						})	

				axios.post('/social_development/health_personnels/get', {year: year})
						.then(data => {
							vm.health_personnels = data.data
						})	
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/social_development/health_facilities/update', {data: vm.health_facilities})
						.then(data => {
						})	
				axios.post('/social_development/health_personnels/update', {data: vm.health_facilities})
						.then(data => {
						})	
			}
		},
		mounted: function(){
			this.getInfo();
		},
		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
	}
</script>