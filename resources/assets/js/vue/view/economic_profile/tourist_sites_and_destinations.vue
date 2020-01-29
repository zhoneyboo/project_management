<template>
	<div id="tourist_sites_and_destinations">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">TOURIST SITES AND DESTINATIONS</h5>
				</div>
			</div>
			<div class="row mt-1">
				<div class="col-md-8">
					<div class="row">
						<template v-for="(data, municipality) in tourist_sites_and_destinations">
							<div class="col-md-6 mt-1">
								<ul class="list-group">
							  		<li class="list-group-item bg-secondary text-white p-2">{{municipality}}</li>

							  		<template v-for="item in data">
							  			<li class="list-group-item p-2 pl-5">
							  				<div class="row justify-content-between">
							  					<div class="col-auto">
							  						{{item.destination}}
							  					</div>
							  					<div class="col-auto">
							  						<button class="btn btn-info btn-sm" @click="setUpdate(item)">
					    								<font-awesome-icon :icon="['far', 'edit']" />
							  						</button>
							  						<button class="btn btn-danger btn-sm" @click="deleteInfo(item.id)">
					    								<font-awesome-icon :icon="['far', 'trash-alt']" />
							  						</button>
							  					</div>
							  				</div>
							  			</li>
							  		</template>
								</ul>
							</div>
						</template>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label>Municipality</label>
								<select class="form-control" v-model="form.municipality">
									<option value="" disabled selected>-- Select Municipality --</option>
									<option v-for="item in municipality" :value="item.id">{{item.municipality}}</option>
								</select>
							</div>

							<div class="form-group">
								<label for="">Tourist Site</label>
								<input type="text" class="form-control" v-model="form.destination">
							</div>
							<button class="btn btn-sm btn-primary" @click="addInfo" v-if="!updateStatus">Submit</button>
							<button class="btn btn-sm btn-info" @click="updateInfo" v-if="updateStatus">Update</button>
							<button class="btn btn-sm btn-danger" @click="updateStatus = false" v-if="updateStatus">Cancel</button>
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
					municipality: '',
					destination: '',
				},
				municipality: [],
				updateStatus: false,
				tourist_sites_and_destinations: [],
			}
		},
		methods:{
			getInfo: function()
			{
				var vm = this;
				axios.post('/economic_profile/tourist_sites_and_destinations/get')
						.then(data => {
							vm.tourist_sites_and_destinations = data.data;
						})
			},
			getInfoMunicipality: function()
			{
				var vm = this;
				axios.post('/municipality/get')
						.then(data => {
							vm.municipality = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/economic_profile/tourist_sites_and_destinations/update', vm.form)
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'TOURIST SITES AND DESTINATIONS')
							vm.getInfo();
							vm.updateStatus = false;
							vm.form = {
									municipality: '',
									destination: '',
								}
						})
			},
			setUpdate: function(form)
			{
				var vm = this;
				vm.updateStatus = true;
				vm.form = form;
			},
			deleteInfo: function(id){
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
					  	axios.post('/economic_profile/tourist_sites_and_destinations/delete', {id: id})
						.then(data => {
							vm.$toastr('success', 'Information is now removed!', 'TOURIST SITES AND DESTINATIONS')
							vm.getInfo();
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
			addInfo: function(){
				var vm = this;
				axios.post('/economic_profile/tourist_sites_and_destinations/create', vm.form)
						.then(data => {
							vm.getInfo();
							vm.form = {
									municipality: '',
									destination: '',
								}
						})
			}
		},
		computed: {

		},
		mounted: function(){
			this.getInfoMunicipality();
			this.getInfo();
		}
	}
</script>