<!-- population_densities -->

<template>
	<div id="population_density_infos">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Population Density</h5>
			</div>
		</div>

		<div class="row mt-1">
			<div class="col-md">
				<table class="table table-light table-bordered mt-1">
					<thead class="text-center">
						<tr>
							<th rowspan="2">City/Municipality</th>
							<th colspan="2">Gross Population Density <br>(per sq. km.)</th>
							<th colspan="2">Urban Population Density <br>(per sq. km.)</th>
							<th>Estimated Gross <br>Population Density</th>
						</tr>
						<tr>
							<th>{{population_density_infos.old_year}}</th>
							<th>{{population_density_infos.actual_year}}</th>
							<th>{{population_density_infos.old_year}}</th>
							<th>{{population_density_infos.actual_year}}</th>
							<th>{{population_density_infos.estimated}}</th>
						</tr>
					</thead>
					<tbody>
						<template v-if="population_densities.length <= 0">
							<tr>
								<td colspan="9">No year selected</td>
							</tr>
						</template>
						<template v-for="item in population_densities">
							<template v-if="item.municipality == 1">
								<tr>
									<th colspan="9">1st District</th>
								</tr>
							</template>
							<template v-if="item.municipality == 9">
								<tr>
									<th colspan="9">2nd District</th>
								</tr>
							</template>

							<tr>
								<td>{{item.municipality_name}}</td>
								<td><currency_label :data="item.gross_old"></currency_label></td>
								<td><currency_label :data="item.gross_actual"></currency_label></td>
								<td><currency_label :data="item.urban_old"></currency_label></td>
								<td><currency_label :data="item.urban_actual"></currency_label></td>
								<td><currency_label :data="item.estimated_gross"></currency_label></td>
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
		props: ["year"],
		data : function(){
			return {
				population_densities: [],
				population_density_infos: [],
				form: {
					old_year: '',
					actual_year: '',
					estimated: '',
				},
				webYear: [],
			}
		},
		methods: {
			getInfo: function(actual_year){
				var vm = this;
				axios.post('/demograph/population_densities/get',{actual_year: actual_year} )
						.then(data => {
							vm.population_densities = data.data.population_densities;
							vm.population_density_infos = data.data.population_density_infos;



						});
			},
		},
		watch: {
			year: function(val){
				if(val != "")
				{
					this.getInfo(val);
				}else{
					this.getInfo();
				}
			}
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		}
	}
</script>

