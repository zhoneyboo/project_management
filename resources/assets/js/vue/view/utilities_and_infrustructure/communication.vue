<template>
	<div id="communication">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Communication</h5>
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
						<th>City/Municipality</th>
						<th>Smart Communication </th>
						<th>Globe Telecom</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="item in communication">
						<tr v-if="item.municipality == 1">
							<td colspan="4">1st District</td>
						</tr>
						<tr v-if="item.municipality == 9">
							<td colspan="4">2nd District</td>
						</tr>
						<tr>
							<td>{{item.municipality_name}}</td>
							<td class="with-input">
								<currency_input v-model="item.smart_communication"></currency_input>
							</td>
							<td class="with-input">
								<currency_input v-model="item.globe_telecom"></currency_input>
							</td>
						</tr>
					</template>
				</tbody>
				<tfoot>
					<tr>
						<th>Total</th>
						<th>{{total.smart_communication}}</th>
						<th>{{total.globe_telecom}}</th>
					</tr>
				</tfoot>
			</table>
	</div>
</template>

<script>
	export default{
		data: function(){
			return {
				year: new Date().getFullYear(),
				communication: [],
				total: {
					smart_communication: 0,
					globe_telecom: 0,
				}
			}
		},
		mounted:function(){
			this.getInfo();
		},
		methods: {
			getInfo: function(year)
			{
				var vm = this;
				axios.post('/infrustructure_and_utilities/communication/get', {year: year})
						.then(data => {
							vm.communication = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/infrustructure_and_utilities/communication/update', {data: vm.communication})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'Communication')
						})
			}
		},
		watch: {
			year: function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			},
			communication: {
				handler: function(val, oldVal){
					var vm = this;
					vm.total.smart_communication = 0;
					vm.total.globe_telecom = 0;
					for (var i = 0; i < val.length; i++) {
						vm.total.smart_communication += parseFloat(val[i].smart_communication);
						vm.total.globe_telecom += parseFloat(val[i].globe_telecom);
					}
				},
				deep: true
			}
		},

		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},

	}
</script>