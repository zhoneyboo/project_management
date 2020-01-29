<template>
	<div id="land_classification_statistic">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Land Classification Statistics</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-4">
				<div class="card">
					<div class="card-body">
						<v-piechart :chartData="dataPie"></v-piechart>
					</div>
				</div>
			</div>
			<div class="col-8">
				<table class="table table-bordered table-light mt-1">
					<thead>
						<tr>
							<th colspan="2">Land Classification Statistics</th>
							<th>Area (Hectares)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Certified Alienable and Disposable Land </td>
							<td class="with-input" width="25%">
							</td>
							<td>
								{{land_classification_statistic.certified_alienable_and_disposable_land}}
							</td>
						</tr>

						<tr>
							<td>Forest Land</td>
							<td class="with-input"  width="25%"> 
							</td>
							<td class="text-right pr-4">
								{{totalForest.toFixed(2)}}
							</td>
						</tr>
						<tr>
							<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unclassified</td>
							<td  width="25%"> 
								{{land_classification_statistic.forest_land_unclassified}}
							</td>
							<td class="with-input">
							</td>
						</tr>
						<tr>
							<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Classified</td>
							<td width="25%"> 
								{{land_classification_statistic.forest_land_classified}}
							</td>
							<td class="with-input">
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		props:["year"],
		data: function(){
			return {
				land_classification_statistic: {
					certified_alienable_and_disposable_land: '',
					forest_land_classified: '',
					forest_land_unclassified: '',
					year: '',
				},
				totalForest: 0,
				dataPie: []
			}
		},
		watch:{
			land_classification_statistic: {
				handler: function(val, oldVal)
				{
					var vm = this;

					vm.totalForest = parseFloat(val.forest_land_classified) + parseFloat(val.forest_land_unclassified);

					var total = parseFloat(vm.totalForest) + parseFloat(val.certified_alienable_and_disposable_land);


					var certified_alienable_and_disposable_land_percent = (parseFloat(val.certified_alienable_and_disposable_land) / parseFloat(total)) * 100;
					var forest_land_percent = (parseFloat(vm.totalForest) / parseFloat(total)) * 100;

					console.log(certified_alienable_and_disposable_land_percent)
					var data = [certified_alienable_and_disposable_land_percent.toFixed(2), forest_land_percent.toFixed(2)];
					vm.fillData(data);


					console.log(vm.dataPie)
					vm.$forceUpdate();

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
		mounted:function(){
			this.getInfo();
			this.fillData([0,0])
		},
		methods: {
			fillData: function(data){
				var vm = this;
				vm.dataPie = {
						  labels: ['Certified Alienable and Disposable Land', 'Forest Land'],
						  datasets: [
						    {
						      label: 'Land Classification Statistics',
						      backgroundColor: ['#4d2600', '#004d00'],
						      data: data
						    }
						  ]
						}
			},
			getInfo: function(year){
				var vm = this;
				axios.post('/land_classification_statistics/get', {year: year})
						.then(data => {
							vm.land_classification_statistic = data.data;
						})
			},

			updateInfo: function(){
				var vm = this;
				axios.post('/land_classification_statistics/update', vm.land_classification_statistic)
						.then(data => {
							console.log(data.data);
						})
			}
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},

	}
</script>