<template>
	<div id="social_welfare_services">
		
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Social Welfare Services</h4>
			</div>
		</div>
		
		<table class="table table-bordered table-light">
			<thead>
				<tr>
					<th class="text-center align-middle" rowspan="2">City/Municipality</th>
					<th class="text-center align-middle"  width="10%" colspan="2">No. of Social Worker</th>
					<th class="text-center align-middle"  width="10%" colspan="2">No. of Day Care Worker</th>
					<th class="text-center align-middle"  width="10%" rowspan="2">No. of Day Care Centers</th>
					<th class="text-center align-middle"  width="10%" colspan="3">No. of Children Served</th>
				</tr>
				<tr>
					<th class="text-center align-middle" width="10%" >Male</th>
					<th class="text-center align-middle" width="10%" >Female</th>
					<th class="text-center align-middle" width="10%" >Male</th>
					<th class="text-center align-middle" width="10%" >Female</th>
					<th class="text-center align-middle" width="10%" >Male</th>
					<th class="text-center align-middle" width="10%" >Female</th>
					<th class="text-center align-middle" width="10%" >Total</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="item in social_welfare_services">
					<tr>
						<td>{{item.municipality}}</td>
						<td class="text-right">{{item.social_worker_male}}</td>
						<td class="text-right">{{item.social_worker_female}}</td>
						<td class="text-right">{{item.day_care_male}}</td>
						<td class="text-right">{{item.day_care_female}}</td>
						<td class="text-right">{{item.no_of_day_care_centers}}</td>
						<td class="text-right">{{item.children_served_male}}</td>
						<td class="text-right">{{item.children_served_female}}</td>
						<td class="text-right">
							{{parseFloat(item.children_served_male) + parseFloat(item.children_served_female)}}
						</td>
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
				social_welfare_services: [],
			}
		},
		methods:{
			getInfo: function(year){
				var vm = this;
				axios.post('/social_development/social_welfare_services/get', {year: year})
					.then(data => {
						vm.social_welfare_services = data.data;
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