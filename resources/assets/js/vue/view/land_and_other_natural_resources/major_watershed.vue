<template>
	<div id="major_watershed">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Major Watersheds, Oriental Mindoro <span v-if="form.year != ''">({{form.year}})</span></h5>
					<small>
						<b>Sources:</b> PENRO-DENR & EMB Files
						<b>Note:</b> Areas (Ha.)/ boundaries are not authoritative; Classification- refers to Water Quality/ Classification
					</small>
					<br>
					<small><b>Source:</b> Philippine Forestry Statistics, 2017</small>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8">
					<table class="table table-light table-border mt-1">
						<thead>
							<tr>
								<th>Name of Watershed</th>
								<th>Location</th>
								<th>Classification</th>
								<th>Area (Hectares)</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr v-if="major_watershed.length <= 0">
								<td colspan="4">No</td>
							</tr>
							<tr v-for="data in major_watershed">
								<td>{{data.name}}</td>
								<td>{{data.location}}</td>
								<td>{{data.classification}}</td>
								<td>{{data.area}}</td>
								<td>
									<button class="btn btn-sm btn-info" @click="updateWatershed(data)">
						    			<font-awesome-icon :icon="['far', 'edit']" />
									</button>
									<button class="btn btn-sm btn-danger" @click="deleteWaterShed(data.id, data.year)">
						    			<font-awesome-icon :icon="['far', 'trash-alt']" />
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-4">
					<div class="card mt-1">
						<div class="card-body">
							<form @submit.prevent="submitInfo">
								<p class="font-weight-bold text-uppercase">Watershed Encoding Form</p>
								<div class="form-group">
									<label for="">Year</label>
									<v-select  v-model="form.year" :options="defaultYear"></v-select>
									<!-- <select class="form-control" v-model="form.year">
										<option value="" disabled selected>-- Select Year --</option>
										<option v-for="item in defaultYear" :value="item">{{item}}</option>
									</select> -->
								</div>
								<div class="form-group">
									<label for="">Major Watershed Name</label>
									<input type="text" class="form-control" v-model="form.name">
								</div>

								<div class="form-group">
									<label for="">Location</label>
									<input type="text" class="form-control" v-model="form.location">
								</div>

								<div class="form-group">
									<label for="">Classification</label>
									<select class="form-control" v-model="form.classification">
										<option value="" disabled selected>-- Select classification --</option>
										<option value="AA">Class AA</option>
										<option value="A">Class A</option>
										<option value="B">Class B</option>
										<option value="C">Class C</option>
										<option value="D">Class D</option>
									</select>
								</div>

								<div class="form-group">
									<label for="">Area (Hectars)</label>
									<currency_input class="form-control" v-model="form.area"></currency_input>
								</div>

								<div class="row justify-content-end">
									<div class="col-auto">
										<button type="submit" class="btn btn-primary" v-if="!updateInfo">Submit</button>
										<button type="button" class="btn btn-danger" v-if="updateInfo">Cancel</button>
										<button type="submit" class="btn btn-info" v-if="updateInfo">Update</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<table class="table table-light table-sm mt-1">
						<thead>
							<tr>
								<th>Classification</th>
								<th>Benificial Use</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Class AA</td>
								<td> Public Water Supply Class I. This class is intended primarily for waters having watersheds which are uninhabited and otherwise protected and which require only approved disinfection in order to meet the National Standards for Drinking Water (NSDW) of the Philippines.</td>
							</tr>
							<tr>
								<td>Class A </td>
								<td>
									Public Water Supply Class II. For sources of water supply that will require complete treatment (coagulation, sedimentation, filtration and disinfection) in order to meet the NSDW.
								</td>
							</tr>
							<tr>
								<td>Class B</td>
								<td>Recreational Water Class I. For primary contact recreation such as bathing, swimming, skin diving, etc. (particularly those designated for tourism purposes).</td>
							</tr>
							<tr>
								<td>Class C</td>
								<td>
									<ol>
										<li>Fishery Water for the propagation and growth of fish and other aquatic resources;
										</li>
										<li>Recreational Water Class II (Boatings, etc.)</li>
										<li>Industrial Water Supply Class I (For manufacturing processes after treatment).</li>
									</ol>
								</td>
							</tr>
							<tr>
								<td>Class D</td>
								<td>
									<ol>
										<li>For agriculture, irrigation, livestock watering, etc.</li>
										<li>Industrial Water Supply Class II (e.g. cooling, etc.)</li>
										<li>Other inland waters, by their quality, belong to this classification.</li>
									</ol>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
	</div>
</template>
<script>
	export default{
		data:function(){
			return {
				form: {
					name: '',
					location: '',
					classification: '',
					area: '0',
					year: new Date().getFullYear(),
				},
				year: new Date().getFullYear(),
				major_watershed: [],
				updateInfo: false,
			}
		},
		watch:{
			'form.year': function(val, oldVal){
				if(val =="" || val == null)
				{
					this.getInfo();
				}else{
					this.getInfoWithYear(val)
				}
			}
		},
		mounted: function(){
			this.getInfo();
		},
		methods:{
			getInfo: function(){
				var vm = this;
				axios.post('/major_watershed/get')
						.then(data => {
							vm.major_watershed = data.data;
						})	
			},
			submitInfo: function(){
				var vm = this;

				if(!vm.updateInfo)
				{
					axios.post('/major_watershed/create', vm.form)
						.then(data => {
							vm.$toastr('success', 'Information is now added!', 'Major Watersheds, Oriental Mindoro')
							vm.clearForm(vm.form.year)
							vm.getInfoWithYear(vm.form.year)
						});
				}else{
					axios.post('/major_watershed/update', vm.form)
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'Major Watersheds, Oriental Mindoro')
							vm.clearForm(vm.form.year)
							vm.getInfoWithYear(vm.form.year)
						});
				}
			},
			clearForm: function(year)
			{
				var vm = this;
				vm.form = {
					name: '',
					location: '',
					classification: '',
					area: '',
					year: year,
				}
				this.updateInfo = false;

			},
			getInfoWithYear: function(year){
				var vm = this;
				axios.post('/major_watershed/get', {year: year})
						.then(data => {
							vm.major_watershed = data.data;
						})	
			},
			updateWatershed: function(info)
			{
				this.form = info;
				this.updateInfo = true;
			},
			deleteWaterShed: function(id, year)
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

					axios.post('/major_watershed/delete',{id: id})
							.then(data => {
								vm.$toastr('success', 'Information is now deleted!', 'Major Watersheds, Oriental Mindoro')
								vm.getInfoWithYear(year)
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

	}
</script>