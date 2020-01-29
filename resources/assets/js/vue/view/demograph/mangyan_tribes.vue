<template>
	<div id="mangyan_tribes">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Mangyan Tribes</h5>
			</div>
		</div>

		<div class="row mt-1">
			<div class="col-md-7">
				<ul class="list-group">
					<template v-for="item in mangyan_tribes">
						<li class="list-group-item">
							<h5 class="font-weight-bold text-uppercase">{{item.mangyan_tribe}}</h5>
							<p>{{item.description}}</p>
							<div class="btn-group">
								<button class="btn btn-primary btn-sm" @click="toggleUpdate(item)">
			    					<font-awesome-icon :icon="['far', 'edit']" />
								</button>
								<button class="btn btn-danger btn-sm" @click="deleteInfo(item)">
			    					<font-awesome-icon :icon="['far', 'trash-alt']" />
								</button>
							</div>
						</li>
					</template>
					<template v-if="mangyan_tribes.length <= 0">
						<li class="list-group-item">No item found!</li>
					</template>
				</ul>
			</div>
			<div class="col-md-5">
				<div class="card">
					<div class="card-body">
						<form @submit.prevent="createInfo">
							<p class="font-weight-bold">FORM</p>
							<div class="form-group">
								<label>Mangyan Tribe Name</label>
								<input type="text" class="form-control" v-model="form.mangyan_tribe">
							</div>
							<div class="form-group">
								<label>Mangyan Tribe Name</label>
								<textarea class="form-control" v-model="form.description" rows="5">
								</textarea>
							</div>

							<div class="row justify-content-end">
								<div class="col-auto">
									<button class="btn btn-primary" v-if="!updateInfo" type="submit">Submit</button>
									<button class="btn btn-info" v-if="updateInfo" type="submit">Update</button>
									<button class="btn btn-primary" type="button" v-if="updateInfo" @click="updateInfo = !updateInfo">Cancel</button>
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
				mangyan_tribes: [],
				form: {
					mangyan_tribe: '',
					description: '',
				},
				updateInfo: false
			}
		},
		methods: {
			getInfo: function(){
				var vm = this;
				axios.post('/demograph/mangyan_tribes/get')
						.then(data => {
							vm.mangyan_tribes = data.data;
						})
			},
			clearForm: function(){
				this.form = {
					mangyan_tribe: '',
					description: '',
				};
			},
			toggleUpdate: function(data){
				this.form = data;
				this.updateInfo = true;
			},
			createInfo: function(){
				var vm = this;
				if(vm.updateInfo)
				{
					axios.post('/demograph/mangyan_tribes/update', vm.form)
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'Mangyan Tribes')
							vm.updateInfo = false;
							vm.getInfo();
						})
				}else{
					axios.post('/demograph/mangyan_tribes/create', vm.form)
						.then(data => {
							vm.$toastr('success', 'Information is now added!', 'Mangyan Tribes')
							vm.getInfo();
						})
				}
				vm.clearForm();
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
					  	axios.post('/demograph/mangyan_tribes/delete', data)
						.then(data => {
							vm.$toastr('success', 'Information is now removed!', 'Mangyan Tribes')
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
		},
		mounted: function(){
			this.getInfo();
		}
	}
</script>