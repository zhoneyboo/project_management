<template>
	<div id="marine_protected_areas">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Coastal Resources (Marine Protected Areas)</h4>
			</div>
		</div>
			<div class="row">
				<div class="col-md">
					<table class="table table-bordered table-light mt-2">
						<thead class="text-center">
							<tr>
								<th>City/Municipality</th>
								<th>Municipal Waters (has.)</th>
								<th>MPA (coral reef habitat) has.</th>
								<th>MPA Percentage Share (%)</th>
							</tr>
						</thead>
						<tbody>
							<template  v-for="data in marine_protected_areas">
								<tr v-if="data.municipality_id == 1" class="bg-secondary text-white">
									<td colspan="4">1st District </td>
								</tr>
								<tr v-if="data.municipality_id == 9" class="bg-secondary text-white">
									<td colspan="4">2nd District</td>
								</tr>

								<tr>
									<td>{{data.municipality}}</td>
									<td class="text-right">
										{{data.municipal_water}}
									</td>
									<td class="text-right" >
										{{data.mpa}}
									</td>
									<td class="text-right" >
										{{data.mpa_percent}}
									</td>
								</tr>
							</template>
						</tbody>
						<tfoot>
							<tr>
								<th>Oriental Mindoro</th>
								<th>{{total_municipal_water.toFixed(2)}}</th>
								<th>{{mpa_total.toFixed(2)}}</th>
								<th>{{mpa_percent_total.toFixed(2)}}</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
	</div>
</template>
<script>
	export default{
		props:['year'],
		data:function(){
			return {
				marine_protected_areas: [],
				total_municipal_water: 0,
				mpa_total: 0,
				mpa_percent_total: 0,
			}
		},
		watch: {
			marine_protected_areas: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total_municipal_water = 0;
					vm.mpa_total = 0;
					vm.mpa_percent_total = 0;



					for (var i = val.length - 1; i >= 0; i--) {
						vm.total_municipal_water += parseFloat(val[i]["municipal_water"]);
						vm.mpa_total += parseFloat(val[i]["mpa"]);
						vm.mpa_percent_total += parseFloat(val[i]["mpa_percent"]);
					}
				},
				deep: true
			},
			year: function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			}
		},
		methods: {
			getInfo:function(year){
				var vm = this;

				axios.post('/coastal_resources/get', {year: year})
					.then(data => {
						vm.marine_protected_areas = data.data;
					})
			},
		},
		mounted:function(){
			this.getInfo();
		}
	}
</script>