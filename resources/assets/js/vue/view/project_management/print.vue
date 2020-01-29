<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<form action="/project/report/print" method="post" target="_blank" >
							<!-- HIDDEN FIELDS -->
							<input type="hidden" v-model="token" name="_token">
							<input type="hidden" v-model="month" name="month" v-if="report_type == 0">
							<input type="hidden" v-model="year" name="year" v-if="report_type == 2">
							<input type="hidden" v-model="quarter_year" name="quarter_year" v-if="report_type == 1">




							<hr>
							<p class="font-weight-bold">REPORT TYPE PROPERTIES</p>
							<div class="form-group">
								<label>Report Type</label>
								<select class="form-control" name="report_type" v-model="report_type">
									<option value="" disabled selected>-- Select Type --</option>
									<option value="all">All</option>
									<option value="0">Monthly Report</option>
									<option value="1">Quarterly Report</option>
									<option value="2">Yearly Report</option>
								</select>
							</div>

							<div class="form-group" v-if="report_type == 0">
								<label>Select Month</label>
								<date-picker v-model="month" lang="en" type="month" format="YYYY-MM" value-type="format"></date-picker>
							</div>



							<div class="form-group" v-if="report_type == 1">
								<label>Select Quarter</label>
								<select name="quarter" class="form-control">
									<option value="0">All</option>
									<option value="1">1st Quarter</option>
									<option value="2">2nd Quarter</option>
									<option value="3">3rd Quarter</option>
									<option value="4">4th Quarter</option>
								</select>
								
							</div>
							<div class="form-group" v-if="report_type == 1">
								<label>Select Year</label>
								<date-picker v-model="quarter_year" lang="en" type="year" format="YYYY" value-type="format"></date-picker>
							</div>

							<div class="form-group" v-if="report_type == 2">
								<label>Select Year</label>
								<date-picker v-model="year" lang="en" type="year" format="YYYY" value-type="format"></date-picker>
							</div>


							<hr>
							<p class="font-weight-bold">OTHER PROPERTIES</p>


							<div class="form-group">
								<label>Monitoring Team</label>
								<select name="monitoring_team" class="form-control" required>
									<option value="" disabled selected>-- Select Monitoring Team --</option>
									<option value="">All</option>
									<option v-for="item in monitoring_team" :value="item.id">{{item.monitor}}</option>
								</select>
							</div>

							<div class="form-group">
								<label for="">Municipality</label>
								<select name="municipality" class="form-control">
									<option value="">All</option>
									<option v-for="item in municipality" :value="item.id">{{item.municipality}}</option>
								</select>
							</div>

							<div class="row">
								<div class="col-md">
									<div class="form-group">
										<label>Fund Source</label>
										<select name="fund_sources" class="form-control">
											<option value="">All</option>
											<option value="0">General Public Services</option>
											<option value="1">Economic Development</option>
											<option value="2">Social Development</option>
											<option value="3">Other Services</option>
										</select>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<label>Available Year</label>
										<select name="fund_source_year" class="form-control">
											<option value="">All</option>
											<option v-for="item in fund_source_year" :value="item.fund_source_year">{{item.fund_source_year}}</option>
										</select>
									</div>
								</div>
							</div>
							
							<hr>
							<p class="font-weight-bold text-uppercase">Page report properties</p>
							<div class="clas-form-group">
								<label>Set Paper size</label>
								<select class="form-control" name="paper_size">
									<option value="letter" selected>Letter (8.5 x 11 inches)</option>
									<option value="a4">A4 (8.27 × 11.69 inches)</option>
									<option value="long_ph">Long PH (8.5 x 13 inches)</option>
								</select>
							</div>

							<div class="clas-form-group">
								<label>Set Page Orientation</label>
								<select class="form-control" name="page_orientation">
									<option value="landscape" selected>Landscape</option>
									<option value="portrait">Portrait</option>
								</select>
							</div>



							<hr>
							<p class="font-weight-bold">Field Report</p>

							<div class="custom-control custom-checkbox">
							  <input  type="checkbox" checked class="custom-control-input" id="control_number" value="control_number" name="control_number">
							  <label class="custom-control-label" for="control_number">Control Number</label>
							</div>
							<div class="custom-control custom-checkbox">
							  <input  type="checkbox" checked class="custom-control-input" id="title" value="title" name="title">
							  <label class="custom-control-label" for="title">Project Title</label>
							</div>

							<div class="custom-control custom-checkbox">
							  <input  type="checkbox" checked class="custom-control-input" id="location" value="location" name="location">
							  <label class="custom-control-label" for="location">Project Location</label>
							</div>

							<div class="custom-control custom-checkbox">
							  <input  type="checkbox" checked class="custom-control-input" id="project_cost" value="project_cost" name="project_cost">
							  <label class="custom-control-label" for="project_cost">Project Cost</label>
							</div>

							<div class="custom-control custom-checkbox">
							  <input  type="checkbox" checked class="custom-control-input" id="fund_source" value="fund_source" name="fund_source">
							  <label class="custom-control-label" for="fund_source">Fund Source</label>
							</div>

							<div class="custom-control custom-checkbox">
							  <input  type="checkbox" checked class="custom-control-input" id="mode_of_implementation" value="mode_of_implementation" name="mode_of_implementation">
							  <label class="custom-control-label" for="mode_of_implementation">Implementation Procedure</label>
							</div>

							<div class="custom-control custom-checkbox">
							  <input  type="checkbox" checked class="custom-control-input" id="month" value="month" name="field_month">
							  <label class="custom-control-label" for="month">Month</label>
							</div>

							<div class="custom-control custom-checkbox">
							  <input  type="checkbox" checked class="custom-control-input" id="year" value="year" name="field_year">
							  <label class="custom-control-label" for="year">Year</label>
							</div>

							<div class="custom-control custom-checkbox">
							  <input  type="checkbox" checked class="custom-control-input" id="monitored_by" value="monitored_by" name="monitored_by">
							  <label class="custom-control-label" for="monitored_by">Monitor</label>
							</div>

							<div class="custom-control custom-checkbox">
							  <input  type="checkbox" checked class="custom-control-input" id="contractor" value="contractor" name="contractor">
							  <label class="custom-control-label" for="contractor">Contractor</label>
							</div>
							<button class="btn btn-primary" type="submit">
								Generate
							</button>
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
				report_fields: [],
				token : document.head.querySelector('meta[name="csrf-token"]').content,
				report_type: '',
				month: '',
				year: '',
				quarter_year: '',
				monitoring_team: [],
				municipality: [],
				fund_source_year: [],
			}
		},
		methods: {
			getMonitoringList: function(){
				var vm = this;
				axios.post('/project/monitoring_team')
					.then(data => {
						vm.monitoring_team = data.data;
					})
			},	
			get_municipality: function(){
				var vm = this;
				axios.post('/municipality/getMunicipalityWithPSGC')
						.then(data => {
							vm.municipality = data.data;
						})
			},
			get_fund_source: function(){
				var vm = this;
				axios.post('/project/get/getFundSourceYear')
						.then(data => {
							vm.fund_source_year = data.data;
						})
			}
		},
		mounted: function(){
			this.get_fund_source();
			this.getMonitoringList();
			this.get_municipality();
		}
	}
</script>