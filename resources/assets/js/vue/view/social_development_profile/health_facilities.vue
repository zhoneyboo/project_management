<template>
	<div id="health_facilities">
	 	<div class="card rounded-0 bg-light mt-1 shadow-sm">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Health Facilities</h5>
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
		<div class="row">
			<div class="col-md">
				<table class="table table-light table-bordered mt-1">
					<thead>
						<tr>
							<th>Facilities</th>
							<th>Number</th>
						</tr>
					</thead>
					<tbody>
						<template v-for="item in health_facilities">
							<tr>
								<td>{{item.facility}}</td>
								<td class="with-input">
									<currency_input v-model="item.number"></currency_input>
								</td>
							</tr>
						</template>
					</tbody>
				</table>
			</div>
			<div class="col-md">
				<table class="table table-light table-bordered mt-1">
					<thead>
						<tr>
							<th>Practitioners (government)</th>
							<th>Number</th>
						</tr>
					</thead>
					<tbody>
						<template v-for="data in health_personnels">
							<tr>
								<td>{{data.personnel}}</td>
								<td class="with-input">
									<currency_input v-model="data.number"></currency_input>
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
		data: function(){
			return {
				health_facilities: [],
				health_personnels: [],
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
				axios.post('/social_development/health_facilities/get', {year: year})
						.then(data => {
							vm.health_facilities = data.data
						})	

				axios.post('/social_development/health_personnels/get', {year: year})
						.then(data => {
							vm.health_personnels = data.data
						})	
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/social_development/health_facilities/update', {data: vm.health_facilities})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'Nutritional Status')
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