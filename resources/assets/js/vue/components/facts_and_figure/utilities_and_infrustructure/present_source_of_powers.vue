<template>
	<div id="present_source_of_powers">
		
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">PRESENT SOURCE OF POWER</h4>
			</div>
		</div>
		<h5 class="font-weight-bold">PRESENT SOURCE OF POWER</h5>
		<table class="table table-bordered table-light">
			<thead class="text-center">
				<tr>
					<th>Power Plant</th>
					<th>Installed Capacity</th>
					<th>Dependable Capacity (MW)</th>
					<th>Location</th>
				</tr>
			</thead>
			<tbody>
				<tr v-if="present_source_of_powers.length <= 0">
					<td colspan="5" class="text-center">No item found!</td>
				</tr>
				<tr v-for="item in present_source_of_powers">
					<td>{{item.power_plant}}</td>
					<td>{{item.installed_capacity}}</td>
					<td>{{item.dependable_capacity}}</td>
					<td>{{item.municipality_name}}</td>
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
				present_source_of_powers: [],
			}
		},
		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/infrustructure_and_utilities/present_source_of_powers/get', {year: year})
						.then(data => {
							vm.present_source_of_powers = data.data;
						})
			},
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
			year :function(val){
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