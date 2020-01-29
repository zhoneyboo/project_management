<template>
	<div id="license_permit_issueds">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">License/Permit issued</h5>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-4 col-md-3 col-lg-2 col-xl-2 ml-auto pr-1">
					<div class="form-group p-0 m-0">
						<span>Year: </span> 
						<v-select  v-model="year" :options="defaultYear"></v-select>
						<!-- <select class="form-control" v-model="year">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select> -->
					</div>
				</div>
				<div class="col-auto d-flex align-items-end p-0">
					<button class="btn btn-primary" @click="updateInfo">Update</button>
				</div>
			</div>
		</div>

		<table class="table table-bordered table-light">
			<thead>
				<tr>
					<th></th>
					<th>1st Semester</th>
					<th>2nd Semester</th>
					<th>Total</th>
				</tr>

			</thead>
			<tbody>
				<tr>
					<th colspan="4">a. Professional</th>
				</tr>
				<tr>
					<td>New</td>
					<td class="with-input">
						<currency_input v-model="license_permit_issueds.pro_new_first_sem"></currency_input>
					</td>
					<td class="with-input">
						<currency_input v-model="license_permit_issueds.pro_new_second_sem"></currency_input>
					</td>
					<td>
						{{
							parseFloat(license_permit_issueds.pro_new_first_sem) +
							parseFloat(license_permit_issueds.pro_new_second_sem)
						}}
					</td>
				</tr>
				<tr>
					<td>Renewal</td>
					<td class="with-input">
						<currency_input v-model="license_permit_issueds.pro_renew_first_sem"></currency_input>
					</td>
					<td class="with-input">
						<currency_input v-model="license_permit_issueds.pro_renew_second_sem"></currency_input>
					</td>
					<td>
						{{
							parseFloat(license_permit_issueds.pro_renew_first_sem) +
							parseFloat(license_permit_issueds.pro_renew_second_sem)
						}}
					</td>
				</tr>

				<tr>
					<th colspan="4">b. Non-Professional</th>
				</tr>
				<tr>
					<td>New</td>
					<td class="with-input">
						<currency_input v-model="license_permit_issueds.non_pro_new_first_sem"></currency_input>
					</td>
					<td class="with-input">
						<currency_input v-model="license_permit_issueds.non_pro_new_second_sem"></currency_input>
					</td>
					<td>
						{{
							parseFloat(license_permit_issueds.non_pro_new_first_sem) +
							parseFloat(license_permit_issueds.non_pro_new_second_sem)
						}}
					</td>
				</tr>
				<tr>
					<td>Renewal</td>
					<td class="with-input">
						<currency_input v-model="license_permit_issueds.non_pro_renew_first_sem"></currency_input>
					</td>
					<td class="with-input">
						<currency_input v-model="license_permit_issueds.non_pro_renew_second_sem"></currency_input>
					</td>
					<td>
						{{
							parseFloat(license_permit_issueds.non_pro_renew_first_sem) +
							parseFloat(license_permit_issueds.non_pro_renew_second_sem)
						}}
					</td>
				</tr>

				<tr>
					<th>c. Student Permit</th>
					<td class="with-input">
						<currency_input v-model="license_permit_issueds.student_first_sem"></currency_input>
					</td>
					<td class="with-input">
						<currency_input v-model="license_permit_issueds.student_second_sem"></currency_input>
					</td>
					<td>
						{{
							parseFloat(license_permit_issueds.student_first_sem) +
							parseFloat(license_permit_issueds.student_second_sem)
						}}
					</td>
				</tr>

			</tbody>
		</table>
	</div>
</template>
<script>
	export default{
		data: function(){
			return {
				year: new Date().getFullYear(),
				license_permit_issueds: []
			}
		},
		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/infrustructure_and_utilities/license_permit_issueds/get', {year: year})
					.then(data => {
						vm.license_permit_issueds = data.data
					})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/infrustructure_and_utilities/license_permit_issueds/update', vm.license_permit_issueds)
					.then(data => {
							vm.$toastr('success', 'Information is now removed!', 'License/Permit issued')
					})
			}

		},
		mounted: function(){
			this.getInfo();
		},
		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			},
		},
		watch: {
			'year': function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			}
		}
	}
</script>
