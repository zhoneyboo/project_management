<template>
	<div id="actual_projected_infos">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Actual and Projected Population and Number of Households, Growth Rate by City/Municipality</h5>
			</div>
		</div>

		<div class="row mt-1">
			<div class="col-md">
				<table class="table table-light table-bordered mt-1">
					<thead class="text-center">
						<tr>
							<th class="align-middle" rowspan="2">Municipality</th>
							<th class="align-middle" colspan="2">{{actual_projected_infos.old_year}}</th>
							<th class="align-middle" colspan="2">{{actual_projected_infos.actual_year}} (Actual)</th>
							<th class="align-middle" colspan="2">{{actual_projected_infos.projected_year}} (Projected)</th>
							<th class="align-middle" colspan="2">Growth Rate</th>
						</tr>
						<tr>
							<th class="align-middle">Total Pop'n</th>
							<th class="align-middle">No. of HHs</th>
							<th class="align-middle">Total Pop'n</th>
							<th class="align-middle">No. of HHs</th>
							<th class="align-middle">Total Pop'n</th>
							<th class="align-middle">No. of HHs</th>
							<th class="align-middle">{{actual_projected_infos.growth_rate_1}}</th>
							<th class="align-middle">{{actual_projected_infos.growth_rate_2}}</th>
						</tr>
					</thead>
					<tbody>
						<template v-if="actual_projecteds.length <= 0">
							<tr>
								<td colspan="9">No year selected</td>
							</tr>
						</template>
						<template v-for="item in actual_projecteds">
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
								<td><currency_label :data="item.old_year_pop"></currency_label></td>
								<td><currency_label :data="item.old_year_hh"></currency_label></td>
								<td><currency_label :data="item.actual_year_pop"></currency_label></td>
								<td><currency_label :data="item.actual_year_hh"></currency_label></td>
								<td><currency_label :data="item.projected_year_pop"></currency_label></td>
								<td><currency_label :data="item.projected_year_hh"></currency_label></td>
								<td><currency_label :data="item.growth_rate_1"></currency_label></td>
								<td><currency_label :data="item.growth_rate_2"></currency_label></td>
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
				actual_projecteds: [],
				actual_projected_infos: [],
				form: {
					old_year: '',
					actual_year: '',
					projected_year: '',
					growth_rate_1: '',
					growth_rate_2: '',
				},
				webYear: [],
			}
		},
		methods: {
			getInfo: function(actual_year){
				var vm = this;
				axios.post('/demograph/actual_projecteds/get',{actual_year: actual_year} )
						.then(data => {
							vm.actual_projecteds = data.data.actual_projected;
							vm.actual_projected_infos = data.data.actual_projected_infos;
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
	}
</script>

