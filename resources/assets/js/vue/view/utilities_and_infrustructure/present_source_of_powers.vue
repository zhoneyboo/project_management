<template>
	<div id="present_source_of_powers">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">PRESENT SOURCE OF POWER</h5>
			</div>
		</div>
		<div class="row mt-1">
			<div class="col-md">
				<table class="table table-bordered table-light">
					<thead>
						<tr>
							<th>Power Plant</th>
							<th>Installed Capacity</th>
							<th>Dependable Capacity (MW)</th>
							<th>Location</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-if="present_source_of_powers.length <= 0">
							<td colspan="5" class="text-center">No item found!</td>
						</tr>
						<tr v-for="item in present_source_of_powers">
							<td>{{item.power_plant}}</td>
							<td>{{item.installed_capacity}}</td>
							<td>{{item.dependable_capacity}}</td>
							<td>{{item.municipality_name}}</td>
							<td>
								<div class="btn-group">
									<button class="btn btn-primary btn-sm" @click="toggleUpdate(item)">Edit</button>
									<button class="btn btn-danger btn-sm" @click="deleteInfo(item)">Delete</button>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<form @submit.prevent="createInfo">
							<div class="form-group">
								<label>Year of Encoding</label>

								<v-select  v-model="form.year" :options="defaultYear"></v-select>
								<!-- <select class="form-control" v-model="form.year">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select> -->
							</div>
							<div class="form-group">
								<label>Power Plant</label>
								<input type="text" class="form-control" v-model="form.power_plant">
							</div>
							<div class="form-group">
								<label>Installed Capacity</label>
								<input type="number" class="form-control" v-model="form.installed_capacity">
							</div>
							<div class="form-group">
								<label>Dependable Capacity</label>
								<input type="number" class="form-control" v-model="form.dependable_capacity">
							</div>
							<div class="form-group">
								<label>Muncipality</label>
								<select class="form-control" v-model="form.municipality">
									<option value="" disabled selected>-- Select Municipality -- </option>
									<option v-for="item in municipality" :value="item.id">{{item.municipality}}</option>
								</select>
							</div>
							<div class="row justify-content-end">
								<div class="col-auto">
									<button class="btn btn-primary" v-if="!updateInfo" type="submit">Submit</button>
									<button class="btn btn-info" v-if="updateInfo" type="submit">Update</button>
									<button class="btn btn-danger" v-if="updateInfo"  type="submit">Delete</button>
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
	export default{
		data: function(){
			return {
				form: {
					power_plant: '',
					installed_capacity: '',
					dependable_capacity: '',
					municipality: '',
					year: new Date().getFullYear(),
				},
				present_source_of_powers: [],
				updateInfo: false,
				municipality: [],
			}
		},
		methods: {
			getMunicipality: function(){
				var vm = this;
				axios.post('/municipality/get')
						.then(data => {
							vm.municipality = data.data;
						})
			},
			getInfo: function(year){
				var vm = this;
				axios.post('/infrustructure_and_utilities/present_source_of_powers/get', {year: year})
						.then(data => {
							vm.present_source_of_powers = data.data;
						})
			},
			createInfo: function(){
				var vm = this;
				if(!vm.updateInfo)
				{
					axios.post('/infrustructure_and_utilities/present_source_of_powers/create', vm.form)
							.then(data => {
								vm.$toastr('success', 'Information is now delete!', 'PRESENT SOURCE OF POWER')
								vm.getInfo(vm.form.year);
							})
				}
				else
				{
					axios.post('/infrustructure_and_utilities/present_source_of_powers/update', vm.form)
							.then(data => {
								vm.$toastr('success', 'Information is now update!', 'PRESENT SOURCE OF POWER')
								vm.getInfo(vm.form.year);
							})
				}
				vm.clearForm(vm.form.year)
			},
			toggleUpdate: function(data){
				var vm = this;
				vm.updateInfo = true;
				vm.form = data;
			},
			deleteInfo: function(data){
				var vm = this;
				axios.post('/infrustructure_and_utilities/present_source_of_powers/delete', data)
						.then(data => {
							vm.$toastr('success', 'Information is now removed!', 'PRESENT SOURCE OF POWER')
							vm.getInfo(vm.form.year);
						})
			},
			clearForm: function(year){
				var vm = this;
				vm.updateInfo = false;
				vm.form = {
					power_plant: '',
					installed_capacity: '',
					dependable_capacity: '',
					municipality: '',
					year: year,
				}
			}
		},
		mounted: function(){
			this.getInfo();
			this.getMunicipality();
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch: {
			'form.year' :function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			}
		}
	}
</script>