<template>
	<div id="personnel_by_status">
		<div class="container">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">PROVINCIAL GOVERNMENT PERSONNEL BY STATUS</h5>
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
						<td class="with-input">
							<currency_input v-model="personnel_by_status.permanent_first_male"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="personnel_by_status.permanent_first_female"></currency_input>
						</td>
						<td>
							{{parseFloat(personnel_by_status.permanent_first_male) +
							parseFloat(personnel_by_status.permanent_first_female)}}
						</td>
					</tr>
					<tr>
						<td>Second Level</td>
						<td class="with-input">
							<currency_input v-model="personnel_by_status.permanent_second_male"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="personnel_by_status.permanent_second_female"></currency_input>
						</td>
						<td>
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
						<td class="with-input">
							<currency_input v-model="personnel_by_status.co_terminous_first_male"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="personnel_by_status.co_terminous_first_female"></currency_input>
						</td>
						<td>
							{{parseFloat(personnel_by_status.co_terminous_first_male) +
							parseFloat(personnel_by_status.co_terminous_first_female)}}
						</td>
					</tr>
					<tr>
						<td>Second Level</td>
						<td class="with-input">
							<currency_input v-model="personnel_by_status.co_terminous_second_male"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="personnel_by_status.co_terminous_second_female"></currency_input>
						</td>
						<td>
							{{parseFloat(personnel_by_status.co_terminous_second_male) +
							parseFloat(personnel_by_status.co_terminous_second_female)}}
						</td>
					</tr>

					<tr>
						<td>Elective</td>
						<td class="with-input">
							<currency_input v-model="personnel_by_status.elective_male"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="personnel_by_status.elective_female"></currency_input>
						</td>
						<td>
							{{parseFloat(personnel_by_status.elective_male) +
							parseFloat(personnel_by_status.elective_female)}}
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>Total</th>
						<td>
							{{
								parseFloat(personnel_by_status.permanent_first_male) +
								parseFloat(personnel_by_status.permanent_second_male) +
								parseFloat(personnel_by_status.co_terminous_first_male) +
								parseFloat(personnel_by_status.co_terminous_second_male) +
								parseFloat(personnel_by_status.elective_male)
							}}
						</td>
						<td>
							{{
								parseFloat(personnel_by_status.permanent_first_female) +
								parseFloat(personnel_by_status.permanent_second_female) +
								parseFloat(personnel_by_status.co_terminous_first_female) +
								parseFloat(personnel_by_status.co_terminous_second_female) +
								parseFloat(personnel_by_status.elective_female)
							}}
						</td>
						<td>
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
	</div>
</template>
<script>
	export default {
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
				year: new Date().getFullYear()
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
							vm.$toastr('success', 'Information is now updated!', 'PROVINCIAL GOVERNMENT PERSONNEL BY STATUS')
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