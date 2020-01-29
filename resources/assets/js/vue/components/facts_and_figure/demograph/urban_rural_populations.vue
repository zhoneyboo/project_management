<template>
	<div id="urban_rural_population_infos">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Urban-Rural Population</h5>
			</div>
		</div>

		<div class="row mt-1">
			<div class="col-md">
				<table class="table table-light table-bordered mt-1">
					<thead class="text-center">
						<tr>
							<th class="align-middle" rowspan="2">City/Municipality</th>
							<th class="align-middle" colspan="3">No. of Barangays</th>
							<th class="align-middle" colspan="4">Population, {{urban_rural_population_infos.population_year_1}}</th>
							<th class="align-middle" colspan="4">Population, {{urban_rural_population_infos.population_year_2}}</th>
						</tr>
						<tr>
							<th>Urban</th>
							<th>Rural</th>
							<th>Total</th>
							<th>Urban</th>
							<th>%</th>
							<th>Rural</th>
							<th>%</th>
							<th>Urban</th>
							<th>%</th>
							<th>Rural</th>
							<th>%</th>
						</tr>
					</thead>
					<tbody>
						<template v-if="urban_rural_populations.length <= 0">
							<tr>
								<td colspan="12">No year selected</td>
							</tr>
						</template>
						<template v-for="item in urban_rural_populations">
							<template v-if="item.municipality == 1">
								<tr>
									<th colspan="12">1st District</th>
								</tr>
							</template>
							<template v-if="item.municipality == 9">
								<tr>
									<th colspan="12">2nd District</th>
								</tr>
							</template>
							<tr>
								<td>{{item.municipality_name}}</td>
								<td><currency_label :data="item.no_of_barangays_urban"> </currency_label></td>
								<td><currency_label :data="item.no_of_barangays_rural"> </currency_label></td>
								<td class="text-right">{{parseFloat(item.no_of_barangays_urban) + parseFloat(item.no_of_barangays_rural)  }}</td>
								<td><currency_label :data="item.population_urban_year_1"> </currency_label></td>
								<td class="text-right">
									{{getPercent(item.population_urban_year_1, item.population_rural_year_1)}}
								</td>
								<td><currency_label :data="item.population_rural_year_1"> </currency_label></td>
								<td class="text-right">
									{{getPercent(item.population_rural_year_1, item.population_urban_year_1)}}
								</td>


								<td><currency_label :data="item.population_urban_year_2"> </currency_label></td>
								<td class="text-right">
									{{getPercent(item.population_urban_year_2, item.population_rural_year_2)}}
								</td>
								<td><currency_label :data="item.population_rural_year_2"> </currency_label></td>
								<td class="text-right">
									{{getPercent(item.population_rural_year_2, item.population_urban_year_2)}}
								</td>
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
				urban_rural_populations: [],
				urban_rural_population_infos: [],
				form: {
					population_year_1: '',
					population_year_2: '',
					year_of_encoding: '',
				},
				webYear: [],
			}
		},
		methods: {
			submitInfo: function(){
				var vm = this;
				axios.post('/demograph/urban_rural_populations/create', vm.form)
						.then(data => {
							vm.$toastr('success', 'Information is now added!', 'Urban-Rural Population')
							vm.getYear();

						});
			},
			clearYear: function(){
				this.year = ""
			},
			getInfo: function(actual_year){
				var vm = this;
				axios.post('/demograph/urban_rural_populations/get',{actual_year: actual_year} )
						.then(data => {
							vm.urban_rural_populations = data.data.urban_rural_populations;
							vm.urban_rural_population_infos = data.data.urban_rural_population_infos;
							vm.getYear();

						});
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/demograph/urban_rural_populations/update', {data: vm.urban_rural_populations})
						.then(data => {
							vm.getYear();
							vm.$toastr('success', 'Information is now updated!', 'Urban-Rural Population')
						})
			},
			getPercent: function(returnVal, otherVal)
			{
				var total = parseFloat(returnVal) + parseFloat(otherVal);
				var percentreturnVal = (returnVal / total) * 100;
				if(isNaN(percentreturnVal))
				{
					return 0;
				}
				return percentreturnVal.toFixed(2);
			},
			getYear: function(){
				var vm = this;
				axios.post('/demograph/urban_rural_populations/getYear')
						.then(data => {
							vm.webYear = data.data;
						})
			}
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
		mounted: function(){
			this.getYear();
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		}
	}
</script>

