<template>
	<div id="land_classification_statistic">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Land Classification Statistics</h5>
					<small>
						Note: <b>ALIENABLE AND DISPOSABLE LANDS</b> refer to those lands of the public domain which have been the subject of the present system of classification and declared as not needed for forest purposes.
					</small>
					<br>
					<small><b>Source:</b> Philippine Forestry Statistics, 2017</small>
				</div>
			</div>
			<div class="container mt-1">
				<div class="row">
					<div class="col-4 col-md-3 col-lg-2 col-xl-2 ml-auto pr-1">
						<div class="form-group p-0 m-0">
							<span>Year: </span> 
							<v-select  v-model="year" :options="defaultYear"></v-select>
							<!-- <select class="form-control" v-model="year">
								<option value="" disabled selected>-- Select Year --</option>
								<option v-for="item in defaultYear" :value="item">{{item}}</option>
							</select> -->
						</div>
					</div>
					<div class="col-auto d-flex align-items-end p-0">
						<button class="btn btn-primary" @click="updateInfo">Update</button>
					</div>
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
								<td class="with-input">
									<currency_input 
											v-model="land_classification_statistic.certified_alienable_and_disposable_land">
									</currency_input>
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
								<td class="with-input"  width="25%"> 
									<currency_input v-model="land_classification_statistic.forest_land_unclassified"></currency_input>
								</td>
								<td class="with-input">
								</td>
							</tr>
							<tr>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Classified</td>
								<td class="with-input"  width="25%"> 
									<currency_input v-model="land_classification_statistic.forest_land_classified"></currency_input>
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
		data: function(){
			return {
				land_classification_statistic: {
					certified_alienable_and_disposable_land: '',
					forest_land_classified: '',
					forest_land_unclassified: '',
					year: '',
				},
				totalForest: 0,
				year: new Date().getFullYear(),
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
				if(val == "" || val == null)
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
							vm.$toastr('success', 'Information is now update!', 'Land Classification Statistics')
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