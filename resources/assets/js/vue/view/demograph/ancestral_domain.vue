<template>
	<div id="ancestral_domain">
		 	<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">List of Ancestral Domain Applications and their status</h5>
				</div>
			</div>

			<div class="row mt-1">
				<div class="col-md-8">
					<table class="table table-light table-bordered">
						<thead>
							<tr>
								<th>Name and Location of Ancestral Domain</th>
								<th>Ethnolunguistic Tribal Group</th>
								<th>Estimated Area (Hectares) of Ancestral Domain</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="item in ancestral_domain">
								<td>{{item.name_address}}</td>
								<td>{{item.ethnolinguistic}}</td>
								<td>{{item.estimated_area}}</td>
								<td>
									<div class="btn-group">
										<button class="btn btn-sm btn-primary" @click="updateInfo(item)">
					    					<font-awesome-icon :icon="['far', 'edit']" />
										</button>
										<button class="btn btn-sm btn-danger" @click="deleteInfo(item.id)">
					    					<font-awesome-icon :icon="['far', 'trash-alt']" />
										</button>
									</div>
								</td>
							</tr>
							<tr v-if="ancestral_domain.length <= 0">
								<td colspan="4">No item</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<form @submit.prevent="submitForm">
								<p>FORM</p>
								<div class="form-group">
									<label for="">Year</label>

									<!-- <select class="form-control" v-model="form.year">
										<option value="" disabled selected>-- Select Year --</option>
										<option v-for="item in defaultYear" :value="item">{{item}}</option>
									</select> -->
									<v-select  v-model="form.year" :options="defaultYear">
									</v-select>
								</div>
								<div class="form-group">
									<label for="">Name and Location of Ancestral Domain</label>
									<input type="text" class="form-control" v-model="form.name_address">
								</div>
								<div class="form-group">
									<label for="">Ethnolunguistic Tribal Group</label>
									<input type="text" class="form-control" v-model="form.ethnolinguistic">
								</div>
								<div class="form-group">
									<label for="">Estimated Area (Hectares) of Ancestral Domain</label>
									<input type="number" step="0.0001" class="form-control" v-model="form.estimated_area">
								</div>
								<button type="submit" class="btn btn-primary" v-if="!updateStatus">Submit</button>
								<button type="submit" class="btn btn-primary" v-if="updateStatus">Update</button>
								<button type="button" class="btn btn-danger" v-if="updateStatus" @click="updateStatus = false">Cancel</button>
							</form>
						</div>
					</div>
				</div>
			</div>
	</div>
</template>
<script>
	export default {
		data: function(){
			return  {
				form: {
					name_address: '',
					ethnolinguistic: '',
					estimated_area: '',
					year: new Date().getFullYear(),
				},
				ancestral_domain: [],
				updateStatus: false,
			}
		},
		methods:{
			submitForm: function(){
				var vm = this;
				if(!vm.updateStatus)
				{
					axios.post('/demograph/ancestral_domain/create', vm.form)
							.then(data => {
							vm.$toastr('success', 'Information is now added!', 'List of Ancestral Domain Applications and their status')
							vm.getInfo(vm.form.year)
							})
				}else{
					axios.post('/demograph/ancestral_domain/update', vm.form)
							.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'List of Ancestral Domain Applications and their status')
							vm.getInfo(vm.form.year)
							})
				}

				vm.updateStatus = false;
				vm.form = {
					name_address: '',
					ethnolinguistic: '',
					estimated_area: '',
					year: vm.form.year,
				}
			},
			getInfo:function(year)
			{
				var vm = this;
				axios.post('/demograph/ancestral_domain/get',{year: year})
						.then(data => {
							vm.ancestral_domain = data.data
						})
			},
			updateInfo: function(val)
			{
				this.form = val;
				this.updateStatus = true
			},
			deleteInfo: function(id)
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
					  	axios.post('/demograph/ancestral_domain/delete',{id: id})
						.then(data => {
							vm.getInfo(vm.form.year);
							vm.$toastr('success', 'Information is now removed!', 'List of Ancestral Domain Applications and their status')
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
			}



		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch: {
			'form.year' : function(val){
				if(val == "")
				{
					this.getInfo()
				}else{
					this.getInfo(val);
				}
			}
		},
		mounted: function(){
			this.getInfo();
		}
	}
</script>