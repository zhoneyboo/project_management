<template>
	<div id="personnel_by_status">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">PROVINCIAL GOVERNMENT PERSONNEL BY STATUS</h4>
			</div>
		</div>
		<table class="table table-light table-bordered mt-1">
			<thead>
				<tr>
					<th width="20%">Status</th>
					<th width="20%">Male</th>
					<th width="20%">Female</th>
					<th width="20%">Total</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>Permanent</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
				<tr>
					<td>First Level</td>
					<td class="text-right">{{personnel_by_status.permanent_first_male}}</td>
					<td class="text-right">{{personnel_by_status.permanent_first_female}}</td>
					<td class="text-right font-weight-bold">
						{{parseFloat(personnel_by_status.permanent_first_male) +
						parseFloat(personnel_by_status.permanent_first_female)}}
					</td>
				</tr>
				<tr>
					<td>Second Level</td>
					<td class="text-right">{{personnel_by_status.permanent_second_male}}</td>
					<td class="text-right">{{personnel_by_status.permanent_second_female}}</td>
					<td class="text-right font-weight-bold">
						{{parseFloat(personnel_by_status.permanent_second_male) +
						parseFloat(personnel_by_status.permanent_second_female)}}
					</td>
				</tr>
				<tr>
					<th>Co-Terminous</th>
					<td></td>
					<td></td>
					<th></th>
				</tr>
				<tr>
					<td>First Level</td>
					<td class="text-right">{{personnel_by_status.co_terminous_first_male}}</td>
					<td class="text-right">{{personnel_by_status.co_terminous_first_female}}</td>
					<td class="text-right font-weight-bold">
						{{parseFloat(personnel_by_status.co_terminous_first_male) +
						parseFloat(personnel_by_status.co_terminous_first_female)}}
					</td>
				</tr>
				<tr>
					<td>Second Level</td>
					<td class="text-right">{{personnel_by_status.co_terminous_second_male}}</td>
					<td class="text-right">{{personnel_by_status.co_terminous_second_female}}</td>
					<td class="text-right font-weight-bold">
						{{parseFloat(personnel_by_status.co_terminous_second_male) +
						parseFloat(personnel_by_status.co_terminous_second_female)}}
					</td>
				</tr>

				<tr>
					<td>Elective</td>
					<td class="text-right">{{personnel_by_status.elective_male}}</td>
					<td class="text-right">{{personnel_by_status.elective_female}}</td>
					<td class="text-right font-weight-bold">
						{{parseFloat(personnel_by_status.elective_male) +
						parseFloat(personnel_by_status.elective_female)}}
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<th>Total</th>
					<td class="text-right font-weight-bold">
						{{
							parseFloat(personnel_by_status.permanent_first_male) +
							parseFloat(personnel_by_status.permanent_second_male) +
							parseFloat(personnel_by_status.co_terminous_first_male) +
							parseFloat(personnel_by_status.co_terminous_second_male) +
							parseFloat(personnel_by_status.elective_male)
						}}
					</td>
					<td class="text-right font-weight-bold">
						{{
							parseFloat(personnel_by_status.permanent_first_female) +
							parseFloat(personnel_by_status.permanent_second_female) +
							parseFloat(personnel_by_status.co_terminous_first_female) +
							parseFloat(personnel_by_status.co_terminous_second_female) +
							parseFloat(personnel_by_status.elective_female)
						}}
					</td>
					<td class="text-right font-weight-bold">
						{{
							parseFloat(personnel_by_status.permanent_first_male) +
							parseFloat(personnel_by_status.permanent_second_male) +
							parseFloat(personnel_by_status.co_terminous_first_male) +
							parseFloat(personnel_by_status.co_terminous_second_male) +
							parseFloat(personnel_by_status.elective_male) +
							parseFloat(personnel_by_status.permanent_first_female) +
							parseFloat(personnel_by_status.permanent_second_female) +
							parseFloat(personnel_by_status.co_terminous_first_female) +
							parseFloat(personnel_by_status.co_terminous_second_female) +
							parseFloat(personnel_by_status.elective_female)
						}}
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
</template>
<script>
	export default {
		props: ["year"],
		data: function(){
			return {
				personnel_by_status: {
					permanent_first_male: '',
					permanent_first_female: '',
					permanent_second_male: '',
					permanent_second_female: '',
					co_terminous_first_male: '',
					co_terminous_first_female: '',
					co_terminous_second_male: '',
					co_terminous_second_female: '',
					elective_male: '',
					elective_female: '',
				},
			}
		},
		methods: {
			getInfo: function(year)
			{
				var vm = this;
				axios.post('/personnel/status/get', {year: year})
					.then(data => {
						vm.personnel_by_status = data.data;
					})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/personnel/status/update', vm.personnel_by_status)
						.then(data => {
							console.log(data);
						})
			}
		},
		mounted: function(){
			this.getInfo();
		},
		watch: {
			year: function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			}
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		}
	}
</script>