<template>
	<div id="communication">
		
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Communication</h4>
			</div>
		</div>
		<table class="table table-bordered table-light">
			<thead>
				<tr>
					<th>City/Municipality</th>
					<th>Smart Communication </th>
					<th>Globe Telecom</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="item in communication">
					<tr v-if="item.municipality == 1">
						<td colspan="4">1st District</td>
					</tr>
					<tr v-if="item.municipality == 9">
						<td colspan="4">2nd District</td>
					</tr>
					<tr>
						<td>{{item.municipality_name}}</td>
						<td class="text-right">{{item.smart_communication}}</td>
						<td class="text-right">{{item.globe_telecom}}</td>
					</tr>
				</template>
			</tbody>
			<tfoot>
				<tr>
					<th>Total</th>
					<th class="text-right">{{total.smart_communication}}</th>
					<th class="text-right">{{total.globe_telecom}}</th>
				</tr>
			</tfoot>
		</table>
	</div>
</template>
<script>
	export default{
		props: ["year"],
		data: function(){
			return {
				communication: [],
				total: {
					smart_communication: 0,
					globe_telecom: 0,
				}
			}
		},
		mounted:function(){
			this.getInfo();
		},
		methods: {
			getInfo: function(year)
			{
				var vm = this;
				axios.post('/infrustructure_and_utilities/communication/get', {year: year})
						.then(data => {
							vm.communication = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/infrustructure_and_utilities/communication/update', {data: vm.communication})
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
			},
			communication: {
				handler: function(val, oldVal){
					var vm = this;
					vm.total.smart_communication = 0;
					vm.total.globe_telecom = 0;
					for (var i = 0; i < val.length; i++) {
						vm.total.smart_communication += parseFloat(val[i].smart_communication);
						vm.total.globe_telecom += parseFloat(val[i].globe_telecom);
					}
				},
				deep: true
			}
		},

		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},

	}
</script>