<template>
	<div id="encoding">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="card">
						<div class="card-body">
							<h5 class="font-weight-bold text-uppercase">NEW PROJECT INFORMATION FORM</h5>
							<hr>
							<div class="alert alert-danger" role="alert" v-if="validate.length != 0">
							  {{message}}
							</div>
							<form @submit.prevent="submit">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="">Project Control Number</label>
											<input type="text" class="form-control" v-model="form.control_number">
											<small class="text-danger" v-if="validate.control_number">{{validate.control_number[0]}}</small>
										</div>
									</div>
									<div class="col-md">
										<div class="form-group">
											<label for="">Project Title</label>
											<input type="text" class="form-control" v-model="form.title">
											<small class="text-danger" v-if="validate.title">{{validate.title[0]}}</small>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md">
										<div class="form-group">
											<label>Municipality</label>
											<v-select  v-model="rawMunicipality" label="municipality" :options="municipality">
												<template slot="option" slot-scope="option">
											        <span :class="option.municipality"></span>
											        {{ option.psgc + " - " + option.municipality }}
											    </template>
											</v-select>
										</div>
									</div>
									<div class="col-md">
										<label>Barangay</label>
										<v-select  v-model="rawBarangay" label="barangay" :options="barangay">
											<template slot="option" slot-scope="option">
										        <span :class="option.barangay"></span>
										        {{ option.psgc + " - " + option.barangay }}
										    </template>
										</v-select>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md">
										<div class="form-group">
											<label for="">Mode of Implementation</label>
											<select class="form-control" v-model="form.mode_of_implementation">
												<option value="" disabled selected>-- Select mode of implementation --</option>
												<option value="0">By Contract</option>
												<option value="1">By Administration</option>
											</select>
											<small class="text-danger" v-if="validate.mode_of_implementation">{{validate.mode_of_implementation[0]}}</small>
										</div>
									</div>
									<div class="col-md" v-if="form.mode_of_implementation == 0 && form.mode_of_implementation != ''">
										<label for="">Contractor Name</label>
										<input type="text" class="form-control" placeholder="Specify Contractor Name" v-model="form.contractor">
									</div>
								</div>

								<div class="form-group">
									<label for="">Sector</label>
									<select class="form-control" v-model="form.sector">
										<option value="" disabled selected>-- Select sector --</option>
										<option value="0">General Public Services</option>
										<option value="1">Economic Development</option>
										<option value="2">Social Development</option>
										<option value="3">Other Services</option>
									</select>
									<small class="text-danger" v-if="validate.sector">{{validate.sector[0]}}</small>
								</div>
								
								<div class="row">
									<div class="col-md">
										<div class="form-group">
											<label for="">Implementing Agency</label>
											<select class="form-control" v-model="form.implementing_agency">
												<option value="" disabled selected>-- Select Implementing Agency --</option>
												<option v-for="item in implementing_agency" :value="item.id">{{item.implementor}}</option>
											</select>
											<small class="text-danger" v-if="validate.implementing_agency">{{validate.implementing_agency[0]}}</small>
										</div>
									</div>
									<div class="col-md" v-if="form.implementing_agency == 1">
										<div class="form-group">
											<label>Local Government Unit</label>
											<select class="form-control" v-model="form.municipality">
												<option value="" disabled selected> -- Select Local Government Unit --</option>
												<option v-for="item in municipality" :value="item.id">{{item.psgc}} - {{item.municipality}}</option>
											</select>
										</div>
									</div>
									<div class="col-md" v-if="form.implementing_agency == 2">
										<div class="form-group" >
											<label>Other Implementing Agency (Specify)</label>
											<input type="text" class="form-control" placeholder="Other Implementing Agency (Specify)" v-model="form.other_implementing_agency">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md">
										<div class="form-group">
											<label>Fund Source</label>
											<select class="form-control" v-model="form.fund_source">
												<option value="" disabled selected>-- Select Fund Source --</option>
												<option value="1">20% Development Fund</option>
												<option value="2">General Fund</option>
												<option value="3">Special Education Fund</option>
												<option value="4">Trust Fund</option>
												<option value="5">Performance Challenge Fund</option>
												<option value="6">Local Government Support Fund</option>
												<option value="7">Others (Please Specify)</option>
											</select>
											<small class="text-danger" v-if="validate.fund_source">{{validate.implementing_agency[0]}}</small>
										</div>
									</div>
									<div class="col-md" v-if="form.fund_source == 7">
										<div class="form-group">
											<label>Specify Fund Source</label>
											<input type="text" class="form-control" v-model="form.specific_fund_source" placeholder="Others Fund Source">
										</div>
									</div>
									<div class="col-md">
										<div class="form-group">
											<label>Fund Source Year</label>
											<v-select  v-model="form.fund_source_year" :options="defaultYear">
											</v-select>
										</div>
									</div>
								</div>
								



							<div class="row">
								<div class="col-md">
									<div class="form-group">
										<label for="">Project Cost</label>
										<input type="text" class="form-control" v-model="project_cost">
										<small class="text-danger" v-if="validate.project_cost">{{validate.project_cost[0]}}</small>
										<small class="text-danger" v-if="!regExpress">Invalid Format (Numbers, dot and comma are allowed)</small>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<label for="">Project Status</label>
										<select class="form-control" v-model="form.status">
											<option value="" disabled>Select Project Status</option>
											<option value="0">On going</option>
											<option value="1">Completed</option>
										</select>
										<small class="text-danger" v-if="validate.status">{{validate.implementing_agency[0]}}</small>
									</div>
								</div>
							</div>
								

								

								<div class="row justify-content-end">
									<div class="col-auto">
										<button type="reset" class="btn btn-danger">Cancel</button>
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>

							</form>

						</div>
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
				form : {
						title: "",
						control_number: "",
						mode_of_implementation: "",
						loc_barangay: "",
						contractor: "",
						loc_municipality: "",
						implementing_agency: "",
						other_implementing_agency: "",
						municipality: "",
						fund_source: "",
						fund_source_year: new Date().getFullYear(),
						sector: "",
						project_cost: "",
						status: "",
						specific_fund_source: "",
				},
				validate:[],
				message:[],
				implementing_agency: [],
				rawMunicipality: [],
				rawBarangay: [],
				barangay: [],
				municipality: [],
				address: [],
				project_cost: ""


			}
		},
		computed: {
			regExpress: function()
			{
				const regex = /^(\d+|\d{1,3},\d{3}|\d{1,3},\d{3},\d{3}|\d{1,3}(,\d{3})*|\d{1,3}(,\d{3})*\.\d+)$/;
				var val = this.project_cost.toString();

				var found = val.match(regex);
				if(found != null)
				{
					this.form.project_cost = this.project_cost.replace(/,/g, '');
					return true;
				}else{
					return false;
				}
			},
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		methods:{
			submit:function(){
				var vm = this;

				axios.post('/project/create', vm.form)
						.then(data => {

							vm.form =  {
										title: '',
										location: '',
										implementing_agency: '',
										sector: '',
										project_cost: '',
										status: '',
								}

							vm.validate = [];
							vm.message = "";
							vm.$toastr('success', 'New project is now added!', 'Project Monitoringv')
						})
						.catch(error => {
							vm.validate = error.response.data.errors;
							vm.message = error.response.data.message;
							vm.$toastr('error', error.response.data.message, 'Project Monitoring')
						})
			},
			get_implementor_agency_lists: function(){
				var vm = this;
				axios.post('/project/implementor_agency_lists/get')
						.then(data => {
							vm.implementing_agency = data.data;
						})
			},
			get_municipality: function(){
				var vm = this;
				axios.post('/municipality/getMunicipalityWithPSGC')
						.then(data => {
							vm.municipality = data.data;
						})
			},
			get_address: function(){
				var vm = this;
				axios.post('/get_addresses')
						.then(data => {
							vm.address = data.data;
						})
			}
		},
		mounted: function(){
			this.get_implementor_agency_lists();
			this.get_municipality();
			this.get_address();
		},
		watch: {
			rawMunicipality: function(val, oldVal)
			{
				var vm = this;
				if(val != null)
				{
					this.form.loc_municipality = val.id;
					axios.post('/municipality/barangay', {id: val.id})
							.then(data => {
								vm.barangay = data.data;
							})

				}
			},
			rawBarangay: function(val, oldVal)
			{
				var vm = this;

				if(val != null)
				{
					this.form.loc_barangay = val.id;
				}
			}
		}

	}
</script>