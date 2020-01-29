<template>
	<div id="power_substations">

		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">POWER SUBSTATION</h4>
			</div>
		</div>
		<table class="table table-bordered table-light">
			<thead>
				<tr>
					<th>Power Substations</th>
					<th>Megavolt Amperes (MVA) Rating</th>
					<th>Ownership</th>
				</tr>
			</thead>
			<tbody>
				<tr v-if="power_substations.length <= 0">
					<td colspan="5" class="text-center">No item found!</td>
				</tr>
				<tr v-for="item in power_substations">
					<td>{{item.power_substation}}</td>
					<td class="text-right">{{item.megavolt_amperes}}</td>
					<td>{{item.ownership}}</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
<script>
	export default{
		props: ["year"],
		data: function(){
			return {
				power_substations: [],
			}
		},
		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/infrustructure_and_utilities/power_substations/get', {year: year})
						.then(data => {
							vm.power_substations = data.data;
						})
			}
		},
		mounted: function(){
			this.getInfo();
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch: {
			'year' :function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			}
		}
	}
</script>
