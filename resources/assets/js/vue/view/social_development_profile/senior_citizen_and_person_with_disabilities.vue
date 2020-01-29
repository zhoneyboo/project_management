<template>
	<div id="senior_citizen_and_person_with_disabilities">
	 	<div class="card rounded-0 bg-light mt-1 shadow-sm">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Senior Citizen and Person with Dissabilities</h5>
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
			<table class="table table-bordered table-light">
				<thead>
					<tr>
						<th rowspan="2">City/Municipality</th>
						<th colspan="3">No. of Registered Senior Citizens</th>
						<th colspan="3">No. of Persons with Disability</th>
					</tr>
					<tr>
						<th>Male</th>
						<th>Female</th>
						<th>Total</th>
						<th>Male</th>
						<th>Female</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="item in senior_citizen_and_person_with_disabilities">
						<tr v-if="item.municipality == 1">
							<td colspan="4">1st District</td>
						</tr>
						<tr v-if="item.municipality == 9">
							<td colspan="4">2nd District</td>
						</tr>
						<tr>
							<td>{{item.municipality_name}}</td>
							<td class="with-input"> 
								<currency_input v-model="item.senior_male"></currency_input>
							</td>
							<td class="with-input"> 
								<currency_input v-model="item.senior_female"></currency_input>
							</td>
							<td>{{parseFloat(item.senior_male) + parseFloat(item.senior_female) }}</td>
							<td class="with-input"> 
								<currency_input v-model="item.disability_male"></currency_input>
							</td>
							<td class="with-input"> 
								<currency_input v-model="item.disability_female"></currency_input>
							</td>
							<td>{{parseFloat(item.disability_male) + parseFloat(item.disability_female) }}</td>
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
				senior_citizen_and_person_with_disabilities: [],
			}
		},
		mounted:function(){
			this.getInfo();
		},
		methods: {
			getInfo: function(year)
			{
				var vm = this;
				axios.post('/social_development/senior_citizen_and_person_with_disabilities/get', {year: year})
						.then(data => {
							vm.senior_citizen_and_person_with_disabilities = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/social_development/senior_citizen_and_person_with_disabilities/update', {data: vm.senior_citizen_and_person_with_disabilities})
						.then(data => {
							console.log(data.data)
						})
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
			}
		},

		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},

	}
</script>