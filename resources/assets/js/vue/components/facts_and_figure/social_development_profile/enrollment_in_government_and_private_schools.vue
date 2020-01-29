<template>
	<div id="enrollment_in_government_and_private_schools">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Enrollment in Government and Private Schools by Level of Education</h4>
			</div>
		</div>
	 	<table class="table table-light table-bordered">
			<thead class="text-center">
				<tr>
					<th class="align-middle" rowspan="3">Educational Level</th>
					<th colspan="5" class="align-middle">{{parseFloat(enrollment_in_government_and_private_schools[0].year)}} - {{parseFloat(enrollment_in_government_and_private_schools[0].year) + 1}}</th>
				</tr>
				<tr>
					<th class="align-middle" colspan="2">Province</th>
					<th class="align-middle" colspan="3">Calapan City</th>
				</tr>
				<tr>
					<th class="align-middle" width="15%">Public</th>
					<th class="align-middle" width="15%">Private</th>
					<th class="align-middle" width="15%">Public</th>
					<th class="align-middle" width="15%">Private</th>
					<th class="align-middle" width="15%">LUC/SUC</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="(item, index) in enrollment_in_government_and_private_schools">
					<tr v-if="index == 2">
						<td colspan="6">Secondary:</td>
					</tr>
					<tr>
						<td><span v-if="index == 2|| index == 3">&nbsp;&nbsp;&nbsp;&nbsp;</span>{{item.educational_level}}</td>
						<td class="text-right">{{item.province_public}}</td>
						<td class="text-right">{{item.province_private}}</td>
						<td class="text-right">{{item.calapan_public}}</td>
						<td class="text-right">{{item.calapan_private}}</td>
						<td class="text-right">{{item.calapan_luc_suc}}</td>
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
				enrollment_in_government_and_private_schools: [{
					year: 0
				}],
			}
		},
		methods:{
			getInfo: function(year){
				var vm = this;
				axios.post('/social_development/enrollment_in_government_and_private_schools/get', {year: year})
					.then(data => {
						vm.enrollment_in_government_and_private_schools = data.data;
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
		}
	}
</script>