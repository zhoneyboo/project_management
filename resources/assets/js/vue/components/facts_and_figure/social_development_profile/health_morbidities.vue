<template>
	<div id="health_morbidities" >
		
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Morbidity: Leading Causes, Number and Rate per 100,000 Population Comparative Five Year Average</h4>
			</div>
		</div>
	 	<table class="table table-light table-bordered mt-1">
		<thead class="text-center">
			<tr>
				<th  class="align-middle" rowspan="2">Causes</th>
				<th  class="align-middle" colspan="2">{{year}}</th>
				<th  class="align-middle" colspan="2">5-Year Average</th>
			</tr>
			<tr>
				<th class="align-middle" >No.</th>
				<th class="align-middle" >Rate</th>
				<th class="align-middle" >No.</th>
				<th class="align-middle" >Rate</th>
			</tr>
		</thead>
		<tbody>
			<tr v-if="health_morbidities.length <= 0">
				<td colspan="5">No item found</td>
			</tr>
			<template v-for="item in health_morbidities">
				<tr>
					<td>{{item.cause}}</td>
					<td class="text-right">{{item.year_no}}</td>
					<td class="text-right">{{item.year_rate}}</td>
					<td class="text-right">{{item.five_year_no}}</td>
					<td class="text-right">{{item.five_year_rate}}</td>
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
				health_morbidities: [],
			}
		},
		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/social_development/health_morbidities/get', {year: year})
						.then(data => {
							vm.health_morbidities = data.data;
						})
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
	}
</script>