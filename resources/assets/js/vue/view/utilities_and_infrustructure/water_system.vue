<template>
	<div id="water_system">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Level III Water System by City/Municipality</h5>
				</div>
			</div>

			<div class="row mt-1">
				<div class="col-md">
					<table class="table table-light table-bordered">
						<thead>
							<tr>
								<th>City/Municipality</th>
								<th>Water Service Provider</th>
								<th>Type of Water Facility</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<template v-for="(data, key) in water_system">
								<template v-for="(item, index) in data">
									<tr v-if="index == 0">
										<td>{{key}}</td>
										<td>{{item.water_service_provider}}</td>
										<td>
											<template v-if="item.type_of_water_facility == 1">Pressure Pump</template>
											<template v-if="item.type_of_water_facility == 2">Gravity-fed</template>
											<template v-if="item.type_of_water_facility == 3">Pressure Pump/Gravity-fed</template>
										</td>
										<td>
											<button class="btn btn-info btn-sm" @click="updateInfo(item)">Edit</button>
										</td>
									</tr>
									<tr v-if="index > 0">
										<td></td>
										<td>{{item.water_service_provider}}</td>
										<td>
											<template v-if="item.type_of_water_facility == 1">Pressure Pump</template>
											<template v-if="item.type_of_water_facility == 2">Gravity-fed</template>
											<template v-if="item.type_of_water_facility == 3">Pressure Pump/Gravity-fed</template>
										</td>
										<td>
											<button class="btn btn-info btn-sm" @click="updateInfo(item)">Edit</button>
										</td>
									</tr>
								</template>
							</template>
							
							<tr v-if="water_system.length <= 0">
								<td colspan="4" class="text-center">No item found!</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md">
					<div class="card">
						<div class="card-body">
							<form @submit.prevent="submitForm">
								<p class="font-weight-bold text-upper">Water System's Form</p>
								<div class="form-group">
									<label for="">Year of Encoding</label>
									<v-select  v-model="form.year" :options="defaultYear"></v-select>
									<!-- <select class="form-control" v-model="form.year">
										<option value="" disabled selected>-- Select Year --</option>
										<option v-for="item in defaultYear" :value="item">{{item}}</option>
									</select> -->
								</div>
								<div class="form-group">
									<label for="">Municipality</label>
									<select class="form-control" v-model="form.municipality">
										<option value="" disabled selected>-- Select Municipality --</option>
										<option v-for="item in municipality" :value="item.id">{{item.municipality}}</option>
									</select>
								</div>
								<div class="form-group">
									<label for="">Water System Service Provider</label>
									<input type="text" class="form-control"  v-model="form.water_service_provider">
								</div>
								<div class="form-group">
									<label for="">Type of Water System</label>
									<select name="" id="" class="form-control"  v-model="form.type_of_water_facility">
										<option value="" disabled selected>-- Select Type of Water System --</option>
										<option value="1">Pressure Pump</option>
										<option value="2">Gravity-fed</option>
										<option value="3">Pressure Pump/Gravity-fed</option>
									</select>
								</div>

								<div class="row justify-content-end">
									<div class="col-auto">
										<button class="btn btn-primary" v-if="!updateSelected">Submit</button>
										<button class="btn btn-success" v-if="updateSelected">Update</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	</div>
</template>
<script>
	export default {
		data:function(){
			return {
				form: {
					municipality: '',
					water_service_provider: '',
					type_of_water_facility: '',
					year: new Date().getFullYear(),
				},
				water_system: [],
				municipality: [],
				updateSelected: false
			}
		},
		methods:{
			getInfo: function(year){
				var vm = this;
				axios.post('/infrustructure_and_utilities/water_system/get', {year: year})
						.then(data => {
							vm.water_system = data.data;
						})
			},
			getMunicipality: function(){
				var vm = this;
				axios.post('/municipality/get')
						.then(data => {
							vm.municipality = data.data
						})
			},
			submitForm: function(){
				var vm = this;
				if(vm.updateSelected)
				{
					axios.post('/infrustructure_and_utilities/water_system/update', vm.form)
						.then(data => {
							vm.getInfo(vm.form.year);
							vm.form.municipality = "";
							vm.form.water_service_provider = "";
							vm.form.type_of_water_facility = "";
							vm.$toastr('success', 'Information is now updated!', 'Water System')
						})
				}else{
					axios.post('/infrustructure_and_utilities/water_system/create', vm.form)
						.then(data => {
							vm.$toastr('success', 'Information is now create!', 'Water System')
							vm.getInfo(vm.form.year);
							vm.form.municipality = "";
							vm.form.water_service_provider = "";
							vm.form.type_of_water_facility = "";
						})
				}
			},
			updateInfo: function(val)
			{
				this.form=val;
				this.updateSelected = true;
			}
		},
		mounted: function(){
			this.getInfo();
			this.getMunicipality()
		},
		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch:{
			'form.year':function(val){
				this.getInfo(val)
			}
		}
		
	}
</script>