<template>
	<div id="performance_indicator_in_public_schools">
		
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Performance Indicators in Public Elementary and Secondary Schools</h4>
			</div>
		</div>
	 	<table class="table table-light table-bordered">
			<thead class="text-center">
				<tr>
					<th class="align-middle" rowspan="2">Educational Level</th>
					<th class="align-middle" colspan="2">Province</th>
					<th class="align-middle" colspan="2">Calapan City</th>
				</tr>
				<tr>
					<th class="align-middle" width="15%">Public</th>
					<th class="align-middle" width="15%">Private</th>
					<th class="align-middle" width="15%">Public</th>
					<th class="align-middle" width="15%">Private</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="(item, index) in performance_indicator_in_public_schools">
					<tr>
						<td>{{item.indicator}}</td>
						<td class="text-right">{{item.province_elementary}}</td>
						<td class="text-right">{{item.province_secondary}}</td>
						<td class="text-right">{{item.calapan_elementary}}</td>
						<td class="text-right">{{item.calapan_secondary}}</td>
					</tr>
				</template>
			</tbody>
		</table>	
	</div>
</template>


<script>
	export default{
		props: ["year"],
		data: function(){
			return {
				performance_indicator_in_public_schools: [{
					year: 0
				}],
			}
		},
		methods:{
			getInfo: function(year){
				var vm = this;
				axios.post('/social_development/performance_indicator_in_public_schools/get', {year: year})
					.then(data => {
						vm.performance_indicator_in_public_schools = data.data;
					})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/social_development/performance_indicator_in_public_schools/update', {data: vm.performance_indicator_in_public_schools})
					.then(data => {
						this.getInfo(vm.year);
					});
			}
		},
		mounted: function(){
			this.getInfo();
		},
		watch: {
			year: {
				handler: function(val, oldVal)
				{
						if(val == "")
						{
							this.getInfo();
						}else{
							this.getInfo(val)
						}
				},
				deep :true
			}
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		}
	}
</script>