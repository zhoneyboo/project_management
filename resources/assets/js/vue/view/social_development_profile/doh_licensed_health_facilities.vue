<template>
	<div id="doh_licensed_health_facilities" >
	 	<div class="card rounded-0 bg-light mt-1 shadow-sm">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">DOH-Licensed Health Facilities</h5>
			</div>
		</div>

		<div class="row mt-1">
			<div class="col-md-8">
				<table class="table table-light table-bordered">
					<thead>
						<tr>
							<th></th>
							<th>Name of Facility</th>
							<th>Address</th>
							<th>Classification</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<template v-for="(data, index) in doh_licensed_health_facilities">
							<tr>
								<td>{{index + 1}}</td>
								<td>{{data.name_of_facility}}</td>
								<td>{{data.address}}</td>
								<td>{{data.classification}}</td>	
								<td>
									<div class="btn-group">
										<button class="btn btn-primary btn-sm" @click="editInfo(data)">edit</button>
										<button class="btn btn-danger btn-sm" @click="deleteInfo(data.id)">delete</button>
									</div>
								</td>				
							</tr>
						</template>
						<template v-if="doh_licensed_health_facilities.length <= 0">
							<tr>
								<td colspan="5">
									No item found
								</td>
							</tr>
						</template>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<form @submit.prevent="addInfo">
							<div class="form-group">
								<label>Name of Facility</label>
								<input type="text" class="form-control" v-model="form.name_of_facility">
							</div>
							<div class="form-group">
								<label>Address</label>
								<input type="text" class="form-control" v-model="form.address">
							</div>
							<div class="form-group">
								<label>Classification</label>
								<select class="form-control" v-model="form.classification">
									<option value="" disabled selected>-- Select classification --</option>
									<option value="Level I">Level I</option>
									<option value="Level II">Level II</option>
									<option value="Infirmary">Infirmary</option>
								</select>
							</div>
							<div class="row justify-content-end">
								<div class="col-auto">
									<button class="btn btn-primary" v-if="!editStatus">Submit</button>
									<button class="btn btn-info" v-if="editStatus" @click="editStatus = false">Cancel</button>
									<button class="btn btn-info" v-if="editStatus">Update</button>
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
				doh_licensed_health_facilities: [],
				form: {
					name_of_facility: '',
					address: '',
					classification: '',
				},
				editStatus : false
			}
		},
		methods:{
			addInfo: function(){
				var vm = this;
				if(vm.editStatus)
				{
					axios.post('/social_development/doh_licensed_health_facilities/update', vm.form)
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'DOH-Licensed Health Facilities')
							vm.getInfo();
							vm.editStatus = false;
						})
				}else{
					axios.post('/social_development/doh_licensed_health_facilities/create', vm.form)
						.then(data => {
							vm.$toastr('success', 'Information is now created!', 'DOH-Licensed Health Facilities')
							vm.getInfo();
						})
				}
			},
			getInfo: function(){
				var vm = this;
				axios.post('/social_development/doh_licensed_health_facilities/get')
						.then(data => {
							vm.doh_licensed_health_facilities = data.data;
						})
			},
			editInfo: function(data){
				var vm = this;
				vm.form = data;
				vm.editStatus = true;
			},
			deleteInfo: function(id){
				var vm = this;
				axios.post('/social_development/doh_licensed_health_facilities/delete', {id: id})
					.then(data => {
						vm.getInfo();
						vm.$toastr('success', 'Information is now removed!', 'DOH-Licensed Health Facilities')
					})
			}
		},
		mounted: function(){
			this.getInfo();
		},
		computed: {
			
		}
	}
</script>