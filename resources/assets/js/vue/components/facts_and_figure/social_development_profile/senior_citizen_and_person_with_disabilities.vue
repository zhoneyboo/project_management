<template>
	<div id="senior_citizen_and_person_with_disabilities">
		
		<table class="table table-bordered table-light">
			<thead class="text-center">
				<tr>
					<th class="align-middle" rowspan="2">City/Municipality</th>
					<th class="align-middle" colspan="3">No. of Registered Senior Citizens</th>
					<th class="align-middle" colspan="3">No. of Persons with Disability</th>
				</tr>
				<tr>
					<th class="align-middle">Male</th>
					<th class="align-middle">Female</th>
					<th class="align-middle">Total</th>
					<th class="align-middle">Male</th>
					<th class="align-middle">Female</th>
					<th class="align-middle">Total</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="item in senior_citizen_and_person_with_disabilities">
					<tr v-if="item.municipality == 1">
						<td colspan="4">1st District</td>
					</tr>
					<tr v-if="item.municipality == 9">
						<td colspan="4">2nd District</td>
					</tr>
					<tr>
						<td>{{item.municipality_name}}</td>
						<td class="text-right">{{item.senior_male}}</td>
						<td class="text-right">{{item.senior_female}}</td>
						<td>{{parseFloat(item.senior_male) + parseFloat(item.senior_female) }}</td>
						<td class="text-right">{{item.disability_male}}</td>
						<td class="text-right">{{item.disability_female}}</td>
						<td class="text-right">{{parseFloat(item.disability_male) + parseFloat(item.disability_female) }}</td>
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
				senior_citizen_and_person_with_disabilities: [],
			}
		},
		mounted:function(){
			this.getInfo();
		},
		methods: {
			getInfo: function(year)
			{
				var vm = this;
				axios.post('/social_development/senior_citizen_and_person_with_disabilities/get', {year: year})
						.then(data => {
							vm.senior_citizen_and_person_with_disabilities = data.data;
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
	}
</script>