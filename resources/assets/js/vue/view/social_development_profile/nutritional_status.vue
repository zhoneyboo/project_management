<template>
	<div id="nutritional_status">
	 	<div class="card rounded-0 bg-light mt-1 shadow-sm">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Nutritional Status</h5>
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
					<button class="btn btn-primary" @click="updateInfo">Update</button>
				</div>
			</div>
		</div>
	
		<table class="table table-light table-bordered mt-1">
			<thead class="text-center">
				<tr>
					<th class="align-middle" rowspan="3">Age Group (months)</th>
					<th class="align-middle" colspan="12">Number of Preschool Children Weighed by Nutritional Status and Sex</th>
				</tr>
				<tr>
					<th class="align-middle" colspan="3">Normal</th>
					<th class="align-middle" colspan="3">Underweight</th>
					<th class="align-middle" colspan="3">Severely Underweight</th>
					<th class="align-middle" colspan="3">Overweight</th>
				</tr>
				<tr>
					<th class="align-middle">Boys</th>
					<th class="align-middle">Girls</th>
					<th class="align-middle">Total</th>

					<th class="align-middle">Boys</th>
					<th class="align-middle">Girls</th>
					<th class="align-middle">Total</th>

					<th class="align-middle">Boys</th>
					<th class="align-middle">Girls</th>
					<th class="align-middle">Total</th>

					<th class="align-middle">Boys</th>
					<th class="align-middle">Girls</th>
					<th class="align-middle">Total</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="item in nutritional_status">
					<tr>
						<td>{{item.age_range}}</td>
						<td class="with-input">
							<currency_input v-model="item.normal_boys"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.normal_girls"></currency_input>
						</td>
						<td>{{parseFloat(item.normal_boys) + parseFloat(item.normal_girls)}}</td>
						<td class="with-input">
							<currency_input v-model="item.underweight_boys"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.underweight_girls"></currency_input>
						</td>
						<td>{{parseFloat(item.underweight_boys) + parseFloat(item.underweight_girls)}}</td>
						<td class="with-input">
							<currency_input v-model="item.severely_boys"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.severely_girls"></currency_input>
						</td>
						<td>{{parseFloat(item.severely_boys) + parseFloat(item.severely_girls)}}</td>
						<td class="with-input">
							<currency_input v-model="item.overweight_boys"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.overweight_girls"></currency_input>
						</td>
						<td>{{parseFloat(item.overweight_boys) + parseFloat(item.overweight_girls)}}</td>
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
				nutritional_status: [],
				year: new Date().getFullYear(),
			}
		},
		watch: {
			year: function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			},
		},
		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/social_development/nutritional_status/get', {year: year})
						.then(data => {
							vm.nutritional_status = data.data
						})	
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/social_development/nutritional_status/update', {data: vm.nutritional_status})
						.then(data => {
						})	
			}
		},
		mounted: function(){
			this.getInfo();
		},
		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
	}
</script>