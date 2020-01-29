<template>
	<div id="enrollment_in_government_and_private_schools">
	 	<div class="card rounded-0 bg-light mt-1 shadow-sm">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Enrollment in Government and Private Schools by Level of Education</h5>
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
					<th rowspan="3">Educational Level</th>
					<th colspan="5" class="text-center">{{parseFloat(enrollment_in_government_and_private_schools[0].year)}} - {{parseFloat(enrollment_in_government_and_private_schools[0].year) + 1}}</th>
				</tr>
				<tr>
					<th colspan="2">Province</th>
					<th colspan="3">Calapan City</th>
				</tr>
				<tr>
					<th width="15%">Public</th>
					<th width="15%">Private</th>
					<th width="15%">Public</th>
					<th width="15%">Private</th>
					<th width="15%">LUC/SUC</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="(item, index) in enrollment_in_government_and_private_schools">
					<tr v-if="index == 2">
						<td colspan="6">Secondary:</td>
					</tr>
					<tr>
						<td><span v-if="index == 2|| index == 3">&nbsp;&nbsp;&nbsp;&nbsp;</span>{{item.educational_level}}</td>
						<td class="with-input">
							<currency_input v-model="item.province_public">
							</currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.province_private">
							</currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.calapan_public">
							</currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.calapan_private">
							</currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.calapan_luc_suc">
							</currency_input>
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
				enrollment_in_government_and_private_schools: [{
					year: 0
				}],
			}
		},
		methods:{
			getInfo: function(year){
				var vm = this;
				axios.post('/social_development/enrollment_in_government_and_private_schools/get', {year: year})
					.then(data => {
						vm.enrollment_in_government_and_private_schools = data.data;
					})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/social_development/enrollment_in_government_and_private_schools/update', {data: vm.enrollment_in_government_and_private_schools})
					.then(data => {
						vm.$toastr('success', 'Information is now updated!', 'Enrollment in Government and Private Schools by Level of Education')
						vm.getInfo(vm.year);
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