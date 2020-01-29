<template>
	<div id="performance_indicator_in_public_schools">
	 	<div class="card rounded-0 bg-light mt-1 shadow-sm">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Performance Indicators in Public Elementary and Secondary Schools</h5>
			</div>
		</div>
		<div class="container">
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
					<div class="col">
						<button class="btn btn-info" @click="updateInfo">Update</button>
					</div>
				</div>
			</div>
		</div>
		<table class="table table-light table-bordered">
			<thead class="text-center">
				<tr>
					<th rowspan="2">Educational Level</th>
					<th colspan="2">Province</th>
					<th colspan="2">Calapan City</th>
				</tr>
				<tr>
					<th width="15%">Public</th>
					<th width="15%">Private</th>
					<th width="15%">Public</th>
					<th width="15%">Private</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="(item, index) in performance_indicator_in_public_schools">
					<tr>
						<td>{{item.indicator}}</td>
						<td class="with-input">
							<currency_input v-model="item.province_elementary"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.province_secondary"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.calapan_elementary"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.calapan_secondary"></currency_input>
						</td>
					</tr>
				</template>
			</tbody>
		</table>
	</div>
</template>


<script>
	export default{
		data: function(){
			return {
				year: new Date().getFullYear(),
				performance_indicator_in_public_schools: [{
					year: 0
				}],
			}
		},
		methods:{
			getInfo: function(year){
				var vm = this;
				axios.post('/social_development/performance_indicator_in_public_schools/get', {year: year})
					.then(data => {
						vm.performance_indicator_in_public_schools = data.data;
					})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/social_development/performance_indicator_in_public_schools/update', {data: vm.performance_indicator_in_public_schools})
					.then(data => {
						this.getInfo(vm.year);
					});
			}
		},
		mounted: function(){
			this.getInfo();
		},
		watch: {
			year: {
				handler: function(val, oldVal)
				{
						if(val == "")
						{
							this.getInfo();
						}else{
							this.getInfo(val)
						}
				},
				deep :true
			}
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		}
	}
</script>