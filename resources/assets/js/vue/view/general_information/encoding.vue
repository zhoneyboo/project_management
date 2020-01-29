<template>
	<div id="encoding">
		<form @submit.prevent="subGeneralInfo">
			<div class="row">
				<div class="col">
					<div class="row justify-content-end">
						<div class="col-auto">
							<button class="btn btn-info" type="button" @click="subGeneralInfo">Update</button>
						</div>
					</div>
					<div class="card mt-1">
						<div class="card-body">
							<div class="form-group">
								<label for="">LOCATION</label>
								<textarea class="form-control" v-model="form.location"></textarea>
							</div>
							<div class="form-group">
								<label for="">TOPOGRAPHY</label>
								<textarea class="form-control" v-model="form.topography"></textarea>
							</div>
							<div class="form-group">
								<label for="">LAND AREA</label>
								<textarea class="form-control" v-model="form.land_area"></textarea>
							</div>
							<div class="form-group">
								<label for="">BOUNDARY</label>
								<textarea class="form-control" v-model="form.boundary"></textarea>
							</div>
							<div class="form-group">
								<label for="">CLIMATE</label>
								<textarea class="form-control" v-model="form.climate"></textarea>
							</div>
							<div class="form-group">
								<label for="">Capital</label>
								<input type="text" class="form-control" v-model="form.capital">
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Date of Approval</label>
										<input type="date" class="form-control" v-model="form.date_of_approval">
									</div>
								</div>
								<div class="col-md-6">
		 							<div class="form-group">
										<label for="">Legal Basis</label>
										<input ty2pe="text" class="form-control" v-model="form.legal_basis">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">No. Component City</label>
										<input type="number" class="form-control" v-model="form.no_of_component_city">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">No. Municipalities</label>
										<input type="number" class="form-control" v-model="form.no_of_municipality">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">No. Congressional Districts</label>
										<input type="number" class="form-control" v-model="form.no_of_congressional_district">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">No. Barangays</label>
										<input type="number" class="form-control" v-model="form.no_of_barangay">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</template>
<script>

	export default{
		data:function(){
			var data = {
				form: {
					location : '',
					topography : '',
					land_area : '',
					boundary : '',
					climate : '',
					capital : '',
					date_of_approval : '',
					legal_basis : '',
					no_of_component_city : '',
					no_of_municipality : '',
					no_of_congressional_district : '',
					no_of_barangay : '',
					year : '',
				},
				year: "",
				update:false,
				canSubmit:false,
			};
			return data;
		},
		mounted: function(){
			this.getInfo();
		},
		methods:{
			getInfo: function(){
				var vm = this;
				axios.post('/general_information/getYear')
						.then(data => {
							if(data.data.length != 0)
							{
								vm.form = data.data;
								vm.update = true;
							}else{
								vm.update = false;
								vm.$toastr('error', 'No general information found!', 'GENERAL INFORMATION')
							}
						});
			},
			clearForm: function(val = ''){
				var vm = this;
				vm.form = {
						location : '',
						topography : '',
						land_area : '',
						boundary : '',
						climate : '',
						capital : '',
						date_of_approval : '',
						legal_basis : '',
						no_of_component_city : '',
						no_of_municipality : '',
						no_of_congressional_district : '',
						no_of_barangay : '',
						year :  val,
					}
			},
			subGeneralInfo:function(){
				var vm = this;
				axios.post('/general_information/update', vm.form)
						.then(data => {
							vm.$toastr('success', 'General Information is now updated!', 'GENERAL INFORMATION')
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
