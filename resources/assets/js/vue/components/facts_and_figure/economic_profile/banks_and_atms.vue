<template>
	<div id="banks_and_atms">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">NUMBER OF BANKs AND ATMs BY CITY/MUNICIPALITY</h4>
			</div>
		</div>
		<table class="table table-bordered table-light">
			<thead>
				<tr>
					<th>City/Municipality</th>
					<th class="text-center">Banks</th>
					<th class="text-center">ATMs</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="item in banks_and_atms">
					<tr v-if="item.municipality == 1">
						<td colspan="4">1st District</td>
					</tr>
					<tr v-if="item.municipality == 9">
						<td colspan="4">2nd District</td>
					</tr>
					<tr>
						<td>{{item.municipality_name}}</td>
						<td class="text-right">{{item.banks}}</td>
						<td class="text-right">{{item.atm}}</td>
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
				banks_and_atms: [],
			}
		},
		mounted:function(){
			this.getInfo();
		},
		methods: {
			getInfo: function(year)
			{
				var vm = this;
				axios.post('/economic_profile/banks_and_atms/get', {year: year})
						.then(data => {
							vm.banks_and_atms = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/economic_profile/banks_and_atms/update', {data: vm.banks_and_atms})
						.then(data => {
							console.log(data.data)
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