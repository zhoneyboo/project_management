<template>
	<div id="established_marine_protected_areas">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Established Marine Protected Areas</h5>
					<small><b>Source:</b> Provincial Agriculture Office-Fisheries & CRM Division, 2017</small>
				</div>
			</div>


			<div class="row mt-1">
				<div class="col-md-8">
					<table class="table table-light">
						<thead>
							<tr>
								<th>Name of MPA</th>
								<th>Location</th>
								<th>Year Established</th>
								<th>Estimated Area (Has.)</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<template v-for="(data, municipality) in established_marine_protected_areas">
								<tr class="bg-secondary text-white">
									<td colspan="5">{{municipality}}</td>
								</tr>

								<template v-for="item in data">
									<tr>
										<td>{{item.name_of_mpa}}</td>
										<td>{{item.location}}</td>
										<td>{{item.year_stablished}}</td>
										<td>{{item.estimated_area}}</td>
										<td>
											<button class="btn btn-sm btn-primary" @click="editForm(item)">
						    					<font-awesome-icon :icon="['far', 'edit']" />
											</button>
											<button class="btn btn-sm btn-danger" @click="deleteForm(item)">
						    					<font-awesome-icon :icon="['far', 'trash-alt']" />
											</button>
										</td>
									</tr>
								</template>
							</template>
							<template>
								<tr v-if="established_marine_protected_areas.length <= 0" class="text-center">
									<td colspan="5">No item found!</td>
								</tr>
							</template>
						</tbody>
					</table>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<form @submit.prevent="submitForm">
								
								<!-- <div class="form-group">
									<label for="">Year of Encoding</label>
									<v-select  v-model="form.year" :options="defaultYear"></v-select> -->
									<!-- <select class="form-control" v-model="form.year">
										<option value="" disabled selected>-- Select Year --</option>
										<option v-for="item in defaultYear" :value="item">{{item}}</option>
									</select> -->
								<!-- </div> -->

								<div class="form-group">
									<label>Municipality</label>
									<select class="form-control" v-model="form.municipality">
										<option value="" disabled selected>-- Select Municipality --</option>
										<option v-for="data in municipality" :value="data.id">{{data.municipality}}</option>
									</select>
								</div>

								<div class="form-group">
									<label for="">Name of MPA</label>
									<input type="text" class="form-control" v-model="form.name_of_mpa">
								</div>

								<div class="form-group">
									<label for="">Location</label>
									<input type="text" class="form-control"  v-model="form.location">
								</div>

								<div class="form-group">
									<label for="">Year Established</label>
									<v-select  v-model="form.year" :options="defaultYear"></v-select>
									<!-- <select class="form-control" v-model="form.year_stablished">
										<option value="" disabled selected>-- Select Year --</option>
										<option v-for="item in defaultYear" :value="item">{{item}}</option>
									</select> -->
								</div>

								<div class="form-group">
									<label for="">Estimated Area</label>
									<currency_input class="form-control"  v-model="form.estimated_area"></currency_input>
								</div>
								<div class="row justify-content-end">
									<div class="col-md-auto">
											<button class="btn btn-primary" type="submit" v-if="!editInfo">Submit</button>
											<button class="btn btn-danger" type="button" @click="editInfo = !editInfo" v-if="editInfo">Cancel</button>
											<button class="btn btn-info" type="submit" v-if="editInfo">Update</button>
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
		data:function(){
			return {
				municipality: [],
				form: {
					municipality: '',
					name_of_mpa: '',
					location: '',
					year_stablished: '',
					estimated_area: '',
					year: new Date().getFullYear(),
				},
				editInfo: false,
				established_marine_protected_areas: [],
			}
		},
		mounted:function(){
			this.getInfo();
			this.getMunipality();
			this.getYear();
		},
		methods:{
			getMunipality:function(){
				var vm = this;
				axios.post('/municipality/watershed')
						.then(data => {
							vm.municipality = data.data;
						})
			},
			getYear: function(){
				var current_year = (new Date()).getFullYear() + 1;
				var start_year = 2000;

				var arr = [];

				for (var i = start_year; i < current_year; i++) {
					arr.push(i)
				}
				return arr;
			},
			editForm: function(data)
			{
				this.editInfo = true;
				this.form = data;
			},
			submitForm: function(){
				var vm = this;
				if(vm.editInfo)
				{
					axios.post('/established_marine_protected_areas/update', vm.form)
						.then(data => {
							vm.editInfo = false;
							vm.getInfoYear(vm.form.year);
							vm.clearForm(vm.form.year);
							vm.$toastr('success', 'Established Marine Protected Areas is now updated!', 'Established Marine Protected Areas')
						})
				}else{
					axios.post('/established_marine_protected_areas/create', vm.form)
						.then(data => {
							vm.clearForm(vm.form.year);
							vm.getInfoYear(vm.form.year);
							vm.$toastr('success', 'Established Marine Protected Areas is now added!', 'Established Marine Protected Areas')
						})
				}
			},
			deleteForm: function(data)
			{

				var vm = this;
				vm.$swal({
					  title: 'Are you sure?',
					  text: "You won't be able to revert this!",
					  type: 'warning',
					  showCancelButton: true,
					  confirmButtonText: 'Yes, delete it!',
					  cancelButtonText: 'No, cancel!',
					  reverseButtons: true
					}).then((result) => {
					  if (result.value) {

						axios.post('/established_marine_protected_areas/delete', {id:data.id})
							.then(data => {
								vm.$toastr('info', 'Established Marine Protected Areas is now deleted!', 'Established Marine Protected Areas')
								vm.getInfoYear(data.year);
								vm.$swal(
									      'Deleted!',
									      'Your file has been deleted.',
									      'success'
									    )
							})
					  } 
					  else if (result.dismiss === vm.$swal.DismissReason.cancel) 
					  {
					    vm.$swal(
					      'Cancelled',
					      'Your imaginary file is safe :)',
					      'error'
					    )
					  }
					})

			},

			getInfoYear: function(year){
				var vm = this;
				axios.post('/established_marine_protected_areas/get')
						.then(data => {
							vm.established_marine_protected_areas = data.data;
						})
			},

			clearForm: function(year){
				var vm = this;
				vm.form = {
					municipality: '',
					name_of_mpa: '',
					location: '',
					year_stablished: '',
					estimated_area: '',
					year: year,
				}
			},

			getInfo: function(year){
				var vm = this;
				axios.post('/established_marine_protected_areas/get',{year: year})
						.then(data => {
							vm.established_marine_protected_areas = data.data;
						})
			}
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch: {
			'form.year' :function(val)
			{
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