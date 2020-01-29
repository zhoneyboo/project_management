<style>
	.fixed-height{
		max-height: 350px;
		overflow-y: auto;
		border: 1px solid rgba(0,0,0,0.15);
	}

</style>
<template>
	<div id="list">
		<!-- <fileupload :data="{folder: '123'}" url="/test/upload"></fileupload> -->
		<div class="container-fluid">
			<div class="card rounded-0">
				<div class="card-body  p-0 pt-2 pb-2 pl-4">
					<h5 class="font-weight-bold text-uppercase">Project List</h5>
					<small><b>Note: </b> *MT stand for Monitoring Team</small>
				</div>
			</div>	

			<v-datatable 
				class="mt-1"
				:data="list" 
				:fields="fields"
				:centerField="centerField"
				:rightField="rightField"
				:responsiveColumn="responsiveColumn"
				tclass="table-sm table-striped table-light"
				:otherFields="otherField">
				<thead slot="thead" class="text-center text-uppercase">
					<tr>
						<th width="5%">ID</th>
						<th>CONTROL NO</th>
						<th>Project Title</th>
						<th>Project Cost</th>
						<th>Project Status</th>
						<th>Monitored By</th>
						<th>Date Monitored</th>
						<th width="5%">Action</th>
					</tr>
				</thead>
				<template slot="status" slot-scope="props">
					<span v-if="props.row.status == 0" class="badge badge-warning">Ongoing</span>
					<span v-if="props.row.status == 1" class="badge badge-success">Completed</span>
				</template>

				<template slot="monitoring_status" slot-scope="props">
					<span v-if="props.row.monitoring_status == 0" class="badge badge-warning">Not Monitored</span>
					<span v-if="props.row.monitoring_status == 1" class="badge badge-success">Monitored</span>
				</template>

				<template slot="action" slot-scope="props" href="#">
					<div class="btn-group">
						<button class="btn btn-secondary btn-sm"  @click="showDetail(props.row)">
						    <font-awesome-icon :icon="['far', 'eye']" />
						</button>

						<button class="btn btn-primary btn-sm"  @click="setLink(props.row)">
						    <font-awesome-icon :icon="['fas', 'link']" />
						</button>

						<button class="btn btn-info btn-sm" @click="setMonitor(props.row)">Set MT</button>

						<button class="btn btn-warning btn-sm"  @click="showModal(props.row)">
						    <font-awesome-icon :icon="['far', 'edit']" />
						</button>
					</div>

				</template>
			</v-datatable>

			
		</div>

		<!-- <fileupload @event="multipleFileChange" url="/test/upload"></fileupload> -->

		<modal id="addLink" title="UPDATE ATTACHMENT LINK" footer="false" large="true">
			<div slot="modal-body">
				<span><b>Uploaded Files:</b></span>
				<table class="table table-sm p-0 m-0">
					<thead class="bg-dark text-white">
						<tr>
							<th>Filename</th>
							<th width="90px" class="text-center">Action</th>
						</tr>
					</thead>
				</table>
				<div class="fixed-height m-0">
					<table class="table table-sm m-0 ">
						<tbody>
							<tr v-if="active_file.length <= 0">
								<td colspan="2" class="text-center p-2">No file attached.</td>
							</tr>
							<tr v-for="item in active_file">
								<td style="font-size: 0.88em" width="50%">{{item.filename}}</td>
								<td class="text-right">
										<button type="button" @click="remove_file(item.url)" class="btn btn-danger btn-sm p-1">
								    		<font-awesome-icon :icon="['far', 'trash-alt']"/> Remove
										</button>

										<a :href="item.url" target="_blank" class="btn btn-secondary btn-sm p-1">
								    		<font-awesome-icon :icon="['far', 'eye']"/> View
										</a>
										<a :href="item.url" download class="btn btn-primary btn-sm p-1">
								    		<font-awesome-icon :icon="['fas', 'cloud-download-alt']" /> Download
										</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div slot="other"  class="modal-body border-top">
				<div>
					<p class="font-weight-bold p-0 m-0">Add Attachment </p>
					<fileupload url="/project/upload/attached_file" @getData="getAttachedFile" :data="{control_number: form.control_number}"></fileupload>

						<!-- <div class="custom-input-file">
							<input type="file" class="form-file-control" multiple @change="multipleFileChange" accept="application/pdf">
							<label>Choose File . . . </label>
						</div>
						<p class="font-weight-bold p-0 m-0">Selected Files: <span v-if="files.length < 1">No item selected!</span></p>
						<div class="fixed-height border"  v-if="files.length > 0">
							<ul v-if="files.length > 0" class="m-0">
								<template v-for="(item, index) in files">
									<li> 
										<button class="btn btn-link text-danger btn-sm" @click="files.splice(index, 1)">
											   <font-awesome-icon :icon="['far', 'trash-alt']" />
										</button>
										<small>{{item.filename}}</small>
									</li>
								</template>
							</ul>
						</div>

						<div class="row justify-content-end mt-1">
							<div class="col-auto">
								<button class="btn btn-primary btn-sm" @click="uploadFile">Upload</button>
							</div>
						</div> -->
				</div>
			</div>
		</modal>

		<modal id="modalSetMonitor" title="UPDATE MONITORING TEAM" footer="false">
			<div slot="modal-body"> 
				<div class="form-group">
					<label for="">Monitored By: </label>
					<select v-model="monitor_form.monitored_by" name="" id="" class="form-control">
						<option value="" disabled selected>-- Select Monitoring Personnel</option>
						<option v-for="data in monitoring_team" :value="data.id">{{data.monitor}}</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Date of Monitoring</label>
					<input v-model="monitor_form.date_monitored" type="date" class="form-control">
				</div>

				<div class="row justify-content-end">
					<div class="col-auto">
						<button class="btn btn-primary" @click="updateMonitor">Submit</button>
					</div>
				</div>
			</div>
		</modal>

		<modal id="viewDetail" title="PROJECT INFORMATION" positive_button="Save and exit" footer="false">
			<div slot="modal-body">
				<div class="row">
					<div class="col">
						<p>Project Control Number</p>
					</div>
					<div class="col">
						<p>{{info.control_number}}</p>
					</div>
				</div>
				
				<div class="row">
					<div class="col">
						<p>Project Title</p>
					</div>
					<div class="col">
						<p>{{info.title}}</p>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<p>Municipality</p>
					</div>
					<div class="col">
						<p v-if="info.location_municipality">
							{{info.location_municipality.municipality}}
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<p>Barangay</p>
					</div>
					<div class="col">
						<p v-if="info.location_barangay">
							{{info.location_barangay.barangay}}
						</p>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<p>Mode of Implementation</p>
					</div>
					<div class="col">
						<p v-if="info.mode_of_implementation == 0">By Contract</p>
						<p v-if="info.mode_of_implementation == 1">By Administration</p>
					</div>
				</div>


				<div class="row" v-if="info.mode_of_implementation == 0">
					<div class="col">
						<p>Contractor Name</p>
					</div>
					<div class="col">
						<p>{{info.contractor}}</p>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<p>Sector</p>
					</div>
					<div class="col">
						<p v-if="info.sector == 0">General Public Services</p>
						<p v-if="info.sector == 1">Economic Development</p>
						<p v-if="info.sector == 2">Social Development</p>
						<p v-if="info.sector == 3">Other Services</p>
					</div>
				</div>
				

				<div class="row">
					<div class="col">
						<p>Implementing Agency</p>
					</div>
					<div class="col">
						<template v-for="item in implementing_agency">
							<p v-if="item.id == info.implementing_agency">{{item.implementor}}</p>
						</template>
					</div>
				</div>
				<div class="row" v-if="info.implementing_agency == 1">
					<div class="col">
						<p>Local Government Unit</p>
					</div>
					<div class="col">
						<template v-for="item in municipality">
							<p v-if="item.id == info.municipality">{{item.municipality}}</p>
						</template>
					</div>
				</div>


				<div class="row" v-if="info.implementing_agency == 2">
					<div class="col">
						<p>Other Implementing Agency (Specify)</p>
					</div>
					<div class="col">
						<p>{{info.other_implementing_agency}}</p>
					</div>
				</div>
				
				<div class="row">
					<div class="col">
						<p>Fund Source</p>
					</div>
					<div class="col">
						<p v-if="info.fund_source == 1">20% Development Fund ({{info.fund_source_year}})</p>
						<p v-if="info.fund_source == 2">General Fund ({{info.fund_source_year}})</p>
						<p v-if="info.fund_source == 3">Special Education Fund ({{info.fund_source_year}})</p>
						<p v-if="info.fund_source == 4">Trust Fund ({{info.fund_source_year}})</p>
						<p v-if="info.fund_source == 5">Performance Challenge Fund ({{info.fund_source_year}})</p>
						<p v-if="info.fund_source == 6">Local Government Support Fund ({{info.fund_source_year}})</p>
						<p v-if="info.fund_source == 7">Others (Please Specify) ({{info.fund_source_year}})</p>
					</div>
				</div>
				<div class="row" v-if="info.fund_source == 7">
					<div class="col">
						<p>Specify Fund Source</p>
					</div>
					<div class="col">
						<p>{{info.specific_fund_source}}</p>
					</div>
				</div>


				<div class="row">
					<div class="col">
						<p>Project Cost</p>
					</div>
					<div class="col">
						<p>{{info.project_cost}}</p>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<p>Project Status</p>
					</div>
					<div class="col">
						<p v-if="info.status == 0">Ongoing</p>
						<p v-if="info.status == 1">Completed</p>
					</div>
				</div>
			</div>
		</modal>
		<modal id="editProject" title="EDIT PROJECT INFORMATION" positive_button="Save and exit" footer="false" large="true">
			<div slot="modal-body">
				<div class="form-group">
						<label for="">Project Control Number</label>
						<input type="text" class="form-control" v-model="form.control_number" readonly>
						<small class="text-danger" v-if="validate.control_number">{{validate.control_number[0]}}</small>
					</div>

					<div class="form-group">
						<label for="">Project Title</label>
						<input type="text" class="form-control" v-model="form.title">
						<small class="text-danger" v-if="validate.title">{{validate.title[0]}}</small>
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
						<div class="col-md" v-if="form.mode_of_implementation == 0">
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
									<option v-for="item in municipality" :value="item.id">{{item.municipality}}</option>
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
					




					<div class="form-group">
						<label for="">Project Cost</label>
						<input type="text" class="form-control" v-model="project_cost">
						<small class="text-danger" v-if="validate.project_cost">{{validate.project_cost[0]}}</small>
						<small class="text-danger" v-if="!regExpress">Invalid Format (Numbers, dot and comma are allowed)</small>
					</div>

					<div class="form-group">
						<label for="">Project Status</label>
						<select class="form-control" v-model="form.status">
							<option value="" disabled>Select Project Status</option>
							<option value="0">Ongoing</option>
							<option value="1">Completed</option>
						</select>
						<small class="text-danger" v-if="validate.status">{{validate.implementing_agency[0]}}</small>
					</div>
			</div>
			<div slot="modal-footer" class="modal-footer">
			        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
			        <button type="button" class="btn btn-primary btn-sm" v-if="regExpress" @click="saveUpdate">Submit</button>
			</div>
		</modal>
	</div>
</template>
<script>
	export default{
		data: function(){			return {
				list: [],
				project_cost: "0.00",
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
				info: [],
				fields: [	'id',
							'control_number',
							'title',
							'project_cost',
							'status',
							'monitored_by',
							'date_monitored',
						],
				responsiveColumn: [0, 1, 2,3],
				otherField:["action"],
				centerField: [0,1,4,5,6],
				rightField: [4],
				validate:[],
				message:[],
				implementing_agency: [],
				municipality: [],
				monitoring_team: [],
				active_monitoring_info: [],
				monitor_form : {
					id: '',
					monitored_by: '',
					date_monitored: '',
					monitoring_status: 1,
				},

				barangay: [],

				address: [],
				rawAdd: "",
				rawMunicipality: [],
				rawBarangay: [],

				files: [],
				active_file: [],


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
			remove_file: function(url){
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
						   axios.post('/project/upload/remove_file', {url: url})
							.then(data => {
								vm.getAttachedFile();
							});		
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
			updateLink: function(){
				var vm = this;
				axios.post('/project/update/link', vm.form)
						.then(data => {
						})
			},
			getAttachedFile: function(){
				var vm = this;
				axios.post('/project/get/attached_file', {control_number: vm.form.control_number})
					.then(data => {
						vm.active_file = data.data;
					})
			},
			setLink: function(info){
				var vm = this;
				axios.post('/project/find', {id: info.id})
					.then(data => {
						vm.form = data.data;
						vm.getAttachedFile();
					})
				
				$('#addLink').modal('show')
			},
			showDetail: function(info){
				var vm = this;
				axios.post('/project/get/getInfo', {id: info.id})
					.then(data => {
						vm.info = data.data;
					})
				$('#viewDetail').modal('show');
			},
			getMonitoringList: function(){
				var vm = this;
				axios.post('/project/monitoring_team')
					.then(data => {
						vm.monitoring_team = data.data;
					})
			},	
			delProject:function(id){
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
					    axios.post('/project/delete', {id: id})
								.then(data => {
									vm.getList();
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
			getList: function(){
				var vm = this;
				axios.post('/project/get')
						.then(data => {
							vm.list = data.data;
						})
			},
			showModal:function(info){
				var vm = this;
				axios.post('/project/find', {id: info.id})
					.then(data => {
						vm.form = data.data;
						vm.project_cost = data.data.project_cost

						for (var i = 0; i < vm.municipality.length; i++) {
							if(data.data.loc_municipality == vm.municipality[i].id)
							{
								vm.rawMunicipality = vm.municipality[i];
							}
						}
						for (var i = 0; i < vm.barangay.length; i++) {
							if(data.data.loc_barangay == vm.barangay[i].id)
							{
								vm.rawBarangay = vm.barangay[i];								
							}
						}

					})
				$('#editProject').modal('show');
			},
			saveUpdate: function(){


				var vm = this;
				axios.post('/project/update', vm.form)
						.then(data => {

							vm.form =  {
								title: '',
								control_number: '', 
								mode_of_implementation: '',
								location: '',
								implementing_agency: '',
								other_implementing_agency: '',
								municipality: '',
								fund_source: '',
								sector: '',
								project_cost: '',
								status: '',
							}
							vm.validate = [];
							vm.message = "";
							$('#editProject').modal('hide');
							vm.getList();
						})
						.catch(error => {
							vm.validate = error.response.data.errors;
							vm.message = error.response.data.message;
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

				axios.post('/municipality/getBarangayWithPSGC')
						.then(data => {
							vm.barangay = data.data;
						})
			},

			setMonitor: function(val)
			{
				
				$('#modalSetMonitor').modal("show");
				this.monitor_form.id = val.id;
			},
			updateMonitor: function()
			{
				var vm = this;
				axios.post('/project/monitor/update', vm.monitor_form)
						.then(data => {
							$('#modalSetMonitor').modal("hide");
							vm.getList();
							vm.$toastr('success', 'Project is now monitored!', 'Projects')
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
		mounted:function(){
			this.getList();
			this.get_implementor_agency_lists();
			this.get_municipality();
			this.getMonitoringList();
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