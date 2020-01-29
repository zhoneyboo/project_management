<template>
	<div id="crime_statistics_and_protective_facilities" >
	 	<div class="card rounded-0 bg-light mt-1 shadow-sm">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Crime Statistics and Protective Facilities</h5>
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
			<template v-for="(data, index) in crime_statistics_and_protective_facilities">
				<tr>
					<th colspan="2">{{index}}</th>
				</tr>
				<template v-for="item in data">
					<tr>
						<td width="50%">{{item.crime}}</td>
						<td class="with-input"><currency_input v-model="item.number"></currency_input></td>
					</tr>
				</template>
			</template>
		</table>
	</div>
</template>


<script>
	export default{
		data: function(){
			return {
				year: new Date().getFullYear(),
				crime_statistics_and_protective_facilities: [],
			}
		},
		methods:{
			getInfo: function(year){
				var vm = this;
				axios.post('/social_development/crime_statistics_and_protective_facilities/get', {year: year})
					.then(data => {
						vm.crime_statistics_and_protective_facilities = data.data;
					})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/social_development/crime_statistics_and_protective_facilities/update', {data: vm.crime_statistics_and_protective_facilities})
					.then(data => {
						vm.$toastr('success', 'Information is now updated!', 'Crime Statistics and Protective Facilities')
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