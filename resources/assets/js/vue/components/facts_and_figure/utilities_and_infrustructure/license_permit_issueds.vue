<template>
	<div id="license_permit_issueds">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">License/Permit issued</h4>
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
					<td class="text-right">{{license_permit_issueds.pro_new_first_sem}}</td>
					<td class="text-right">{{license_permit_issueds.pro_new_second_sem}}</td>
					<td class="text-right">
						{{
							parseFloat(license_permit_issueds.pro_new_first_sem) +
							parseFloat(license_permit_issueds.pro_new_second_sem)
						}}
					</td>
				</tr>
				<tr>
					<td>Renewal</td>
					<td class="text-right">{{license_permit_issueds.pro_renew_first_sem}}</td>
					<td class="text-right">{{license_permit_issueds.pro_renew_second_sem}}</td>
					<td class="text-right">
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
					<td class="text-right">{{license_permit_issueds.non_pro_new_first_sem}}</td>
					<td class="text-right">{{license_permit_issueds.non_pro_new_second_sem}}</td>
					<td class="text-right">
						{{
							parseFloat(license_permit_issueds.non_pro_new_first_sem) +
							parseFloat(license_permit_issueds.non_pro_new_second_sem)
						}}
					</td>
				</tr>
				<tr>
					<td>Renewal</td>
					<td class="text-right">{{license_permit_issueds.non_pro_renew_first_sem}}</td>
					<td class="text-right">{{license_permit_issueds.non_pro_renew_second_sem}}</td>
					<td class="text-right">
						{{
							parseFloat(license_permit_issueds.non_pro_renew_first_sem) +
							parseFloat(license_permit_issueds.non_pro_renew_second_sem)
						}}
					</td>
				</tr>

				<tr>
					<th>c. Student Permit</th>
					<td class="text-right">{{license_permit_issueds.student_first_sem}}</td>
					<td class="text-right">{{license_permit_issueds.student_second_sem}}</td>
					<td class="text-right">
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
		props:["year"],
		data: function(){
			return {
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
		},
		mounted: function(){
			this.getInfo();
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
