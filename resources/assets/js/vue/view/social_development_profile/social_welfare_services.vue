<template>
	<div id="social_welfare_services">
		<div class="card rounded-0 bg-light mt-1 shadow-sm">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Social Welfare Services</h5>
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

		<table class="table table-bordered table-light">
			<thead>
				<tr>
					<th class="text-center align-middle" rowspan="2">City/Municipality</th>
					<th class="text-center align-middle"  width="10%" colspan="2">No. of Social Worker</th>
					<th class="text-center align-middle"  width="10%" colspan="2">No. of Day Care Worker</th>
					<th class="text-center align-middle"  width="10%" rowspan="2">No. of Day Care Centers</th>
					<th class="text-center align-middle"  width="10%" colspan="3">No. of Children Served</th>
				</tr>
				<tr>
					<th class="text-center align-middle" width="10%" >Male</th>
					<th class="text-center align-middle" width="10%" >Female</th>
					<th class="text-center align-middle" width="10%" >Male</th>
					<th class="text-center align-middle" width="10%" >Female</th>
					<th class="text-center align-middle" width="10%" >Male</th>
					<th class="text-center align-middle" width="10%" >Female</th>
					<th class="text-center align-middle" width="10%" >Total</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="item in social_welfare_services">
					<tr>
						<td>{{item.municipality}}</td>
						<td class="with-input">
							<currency_input v-model="item.social_worker_male"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.social_worker_female"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.day_care_male"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.day_care_female"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.no_of_day_care_centers"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.children_served_male"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.children_served_female"></currency_input>
						</td>
						<td>
							{{parseFloat(item.children_served_male) + parseFloat(item.children_served_female)}}
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
				social_welfare_services: [],
			}
		},
		methods:{
			getInfo: function(year){
				var vm = this;
				axios.post('/social_development/social_welfare_services/get', {year: year})
					.then(data => {
						vm.social_welfare_services = data.data;
					})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/social_development/social_welfare_services/update', {data: vm.social_welfare_services})
					.then(data => {
					});
			}
		},
		mounted: function(){
			this.getInfo();
		},
		watch: {
			year: function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val)
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