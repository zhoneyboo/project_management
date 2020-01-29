<template>
	<div id="metallic_mineral_resources">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Location of Metallic Mineral Resources</h5>
			</div>
		</div>
		<div class="row mt-1">
			<div class="col-md">
				<div class="container mt-1">
					<div class="row">
						<div class="col-4 col-md-4 col-lg-4 col-xl-4 ml-auto pr-1">
							<div class="form-group p-0 m-0">
								<span>Year: </span> 
								<v-select  v-model="year" :options="defaultYear"></v-select>
							<!-- 	<select class="form-control" v-model="year">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select> -->
							</div>
						</div>
					</div>
				</div>
				<table class="table table-bordered table-light">
					<thead>
						<tr>
							<th>Mineral</th>
							<th>Location</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-if="metallic_mineral_resources.length <= 0">
							<td colspan="3" class="text-center">No item found!</td>
						</tr>
						<template v-for="item in metallic_mineral_resources">
							<tr>
								<td>{{item.mineral}}</td>
								<td>{{item.municipality}}</td>
								<td width="10">
									<div class="btn-group" v-if="year != ''">
										<button class="btn btn-info btn-sm" @click="updateToggle(item)">
						    				<font-awesome-icon :icon="['far', 'edit']" />
										</button>
										<button class="btn btn-danger btn-sm" @click="deleteInfo(item)">
						    				<font-awesome-icon :icon="['far', 'trash-alt']" />
										</button>
									</div>
								</td>
							</tr>
						</template>
					</tbody>
				</table>
			</div>
			<div class="col-md-4" v-if="year != ''">
				<div class="card">
					<div class="card-body">
						<form @submit.prevent="submitInfo">
							<div class="form-group">
								<label>Mineral</label>
								<input type="text" class="form-control" v-model="form.mineral">
							</div>
							<div class="form-group">
								<label>Location</label>
								<textarea class="form-control" v-model="form.municipality"></textarea>
							</div>

							<div class="row justify-content-end">
								<div class="col-auto">
									<button class="btn btn-primary">Submit</button>
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
				year: new Date().getFullYear(),
				metallic_mineral_resources: [],
				form : {
					mineral: '',
					municipality: '',
					year: new Date().getFullYear(),
				},
				editInfo: false
			}
		},
		mounted:function(){
			this.getInfo();
		},
		methods: {
			getInfo: function(year)
			{
				var vm = this;
				axios.post('/land_and_natural_resources/metallic_mineral_resources/get', {year: year})
						.then(data => {
							vm.metallic_mineral_resources = data.data;
						})
			},
			submitInfo: function(){
				var vm = this;
				vm.form.year = vm.year;
				if(!vm.editInfo)
				{
					axios.post('/land_and_natural_resources/metallic_mineral_resources/create', vm.form)
						.then(data => {
							vm.getInfo(vm.year)
							vm.clearInfo();
							vm.$toastr('success', 'Information is now created!', 'Location of Metallic Mineral Resources')
						})
				}else{
					axios.post('/land_and_natural_resources/metallic_mineral_resources/update', vm.form)
						.then(data => {
							vm.getInfo(vm.year)
							vm.clearInfo();
							vm.$toastr('success', 'Information is now updated!', 'Location of Metallic Mineral Resources')
						})
				}
			},
			updateToggle: function(val){
				var vm = this;
				vm.form = val;
				vm.editInfo = true;
			},
			deleteInfo: function(data){
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
					  	axios.post('/land_and_natural_resources/metallic_mineral_resources/delete', data)
						.then(data => {
							vm.$toastr('success', 'Information is now deleted!', 'Location of Metallic Mineral Resources')
							vm.getInfo(vm.year)
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
			clearInfo: function(){
				var vm = this;
				vm.form.mineral = "";
				vm.form.municipality = "";
				vm.editInfo = false;
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