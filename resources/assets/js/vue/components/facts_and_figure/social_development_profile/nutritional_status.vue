<template>
	<div id="nutritional_status">

		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Nutritional Status</h4>
			</div>
		</div>
			<table class="table table-light table-bordered mt-1">
				<thead class="text-center">
				<tr>
					<th class="align-middle" rowspan="3">Age Group (months)</th>
					<th class="align-middle" colspan="12">Number of Preschool Children Weighed by Nutritional Status and Sex</th>
				</tr>
				<tr>
					<th class="align-middle" colspan="3">Normal</th>
					<th class="align-middle" colspan="3">Underweight</th>
					<th class="align-middle" colspan="3">Severely Underweight</th>
					<th class="align-middle" colspan="3">Overweight</th>
				</tr>
				<tr>
					<th class="align-middle">Boys</th>
					<th class="align-middle">Girls</th>
					<th class="align-middle">Total</th>

					<th class="align-middle">Boys</th>
					<th class="align-middle">Girls</th>
					<th class="align-middle">Total</th>

					<th class="align-middle">Boys</th>
					<th class="align-middle">Girls</th>
					<th class="align-middle">Total</th>

					<th class="align-middle">Boys</th>
					<th class="align-middle">Girls</th>
					<th class="align-middle">Total</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="item in nutritional_status">
					<tr>
						<td>{{item.age_range}}</td>
						<td class="text-right">{{item.normal_boys}}</td>
						<td class="text-right">{{item.normal_girls}}</td>
						<td  class="text-right">{{parseFloat(item.normal_boys) + parseFloat(item.normal_girls)}}</td>
						<td class="text-right">{{item.underweight_boys}}</td>
						<td class="text-right">{{item.underweight_girls}}</td>
						<td  class="text-right">{{parseFloat(item.underweight_boys) + parseFloat(item.underweight_girls)}}</td>
						<td class="text-right">{{item.severely_boys}}</td>
						<td class="text-right">{{item.severely_girls}}</td>
						<td  class="text-right">{{parseFloat(item.severely_boys) + parseFloat(item.severely_girls)}}</td>
						<td class="text-right">{{item.overweight_boys}}</td>
						<td class="text-right">{{item.overweight_girls}}</td>
						<td  class="text-right">{{parseFloat(item.overweight_boys) + parseFloat(item.overweight_girls)}}</td>
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
				nutritional_status: [],
				year: "",
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
				axios.post('/social_development/nutritional_status/get', {year: year})
						.then(data => {
							vm.nutritional_status = data.data
						})	
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/social_development/nutritional_status/update', {data: vm.nutritional_status})
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