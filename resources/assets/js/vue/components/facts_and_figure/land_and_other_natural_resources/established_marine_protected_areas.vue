<template>
	<div id="established_marine_protected_areas">
			<div class="card bg-info">
				<div class="card-body pl-3 pr-3 pt-2 pb-2">
					<h4 class="font-weight-bold text-uppercase text-white">Established Marine Protected Areas</h4>
				</div>
			</div>
			<div class="row mt-1">
				<div class="col-md">
					<table class="table table-light table-bordered">
						<thead>
							<tr>
								<th>Name of MPA</th>
								<th>Location</th>
								<th>Year Established</th>
								<th>Estimated Area (Has.)</th>
							</tr>
						</thead>
						<tbody>
							<template v-for="(data, municipality) in established_marine_protected_areas">
								<tr class="bg-secondary text-white">
									<td colspan="5">{{municipality}}</td>
								</tr>

								<template v-for="item in data">
									<tr>
										<td>{{item.name_of_mpa}}</td>
										<td>{{item.location}}</td>
										<td>{{item.year_stablished}}</td>
										<td>{{item.estimated_area}}</td>
									</tr>
								</template>
							</template>
							<template>
								<tr v-if="established_marine_protected_areas.length <= 0" class="text-center">
									<td colspan="5">No item found!</td>
								</tr>
							</template>
						</tbody>
					</table>
				</div>
			</div>
	</div>
</template>
<script>
	export default{
		props:["year"],
		data:function(){
			return {
				municipality: [],
				editInfo: false,
				established_marine_protected_areas: [],
			}
		},
		mounted:function(){
			this.getInfo();
		},
		methods:{
			getInfo: function(year){
				var vm = this;
				axios.post('/established_marine_protected_areas/get',{year: year})
						.then(data => {
							vm.established_marine_protected_areas = data.data;
						})
			}
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch: {
			'year' :function(val)
			{
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