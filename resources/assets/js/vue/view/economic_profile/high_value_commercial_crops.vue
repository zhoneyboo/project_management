<template>
	<div id="high_value_commercial_crops">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">High Value Commercial Crops (HVCC) Production</h5>
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
			<table class="table table-bordered table-light mt-1">
				<thead>
					<tr>
						<th>Commodity</th>
						<th>Farmers Served</th>
						<th>No. of Trees Planted</th>
						<th>Area Planted (ha)</th>
						<th>Production (MT)</th>
						<th>Average Yield (MT/ha)</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<template v-if="high_value_commercial_crops.length <= 0">
						<tr>
							<td colspan="7" class="text-center">No item found</td>
						</tr>
					</template>
					<template v-for="item in high_value_commercial_crops">
						<tr>
							<td>{{item.commodity}}</td>
							<td class="with-input">
								<currency_input v-model="item.farmers_served"></currency_input>
							</td>
							<td class="with-input">
								<currency_input v-model="item.no_of_trees_planted"></currency_input>
							</td>
							<td class="with-input">
								<currency_input v-model="item.planted_area"></currency_input>
							</td>
							<td class="with-input">
								<currency_input v-model="item.production"></currency_input>
							</td>
							<td class="with-input">
								<currency_input v-model="item.average_yield"></currency_input>
							</td>
							<td>
								<button class="btn btn-danger btn-sm" @click="removeCommodity(item.id)">
					    			<font-awesome-icon :icon="['far', 'trash-alt']" />
								</button>
							</td>
						</tr>
					</template>
				</tbody>
				<tfoot>
					<tr>
						<th>TOTAL</th>
						<th class="text-right">
							<currency_label :data="total.farmers_served"></currency_label>
						</th>
						<th class="text-right">
							<currency_label :data="total.no_of_trees_planted"></currency_label>
						</th>
						<th class="text-right">
							<currency_label :data="total.planted_area"></currency_label>
						</th>
						<th class="text-right">
							<currency_label :data="total.production"></currency_label>
						</th>
						<th class="text-right">
							<currency_label :data="total.average_yield"></currency_label>
						</th>
					</tr>
				</tfoot>
			</table>
			<div class="row" v-if="year != ''">
				<div class="col-4">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label class="font-weight-bold">Add commodity</label>
								<input type="text" class="form-control" v-model="commodity">
							</div>
							<div class="row justify-content-end">
								<div class="col-auto">
									<button class="btn btn-sm btn-primary" @click="addCommodity">Submit</button>
								</div>
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
				year: new Date().getFullYear(),
				commodity: '',
				high_value_commercial_crops: [],
				total: {
					farmers_served: 0,
					no_of_trees_planted: 0,
					planted_area: 0,
					production: 0,
					average_yield: 0,
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
				axios.post('/economic_profile/high_value_commercial_crops/get', {year: year})
						.then(data => {
							vm.high_value_commercial_crops = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/economic_profile/high_value_commercial_crops/update', {data: vm.high_value_commercial_crops})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'High Value Commercial Crops (HVCC) Production')
						})
			},
			addCommodity: function(){
				var vm = this;
				axios.post('/economic_profile/high_value_commercial_crops/create', {commodity: vm.commodity, year: vm.year})
					.then(data => {
						vm.$toastr('success', 'Information is now added!', 'High Value Commercial Crops (HVCC) Production')
						vm.getInfo(vm.year);
						vm.commodity = "";
					})
			},
			removeCommodity: function(id){
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
					  	axios.post('/economic_profile/high_value_commercial_crops/delete', {id: id})
						.then(data => {
							vm.$toastr('success', 'Information is now removed!', 'High Value Commercial Crops (HVCC) Production')
							vm.getInfo(vm.year);
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
		watch: {
			year: function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			},
			high_value_commercial_crops: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total.farmers_served = 0;
					vm.total.no_of_trees_planted = 0;
					vm.total.planted_area = 0;
					vm.total.production = 0;
					vm.total.average_yield = 0;

					for (var i = 0; i < val.length; i++) {
						vm.total.farmers_served += parseFloat(val[i].farmers_served);
						vm.total.no_of_trees_planted += parseFloat(val[i].no_of_trees_planted);
						vm.total.planted_area += parseFloat(val[i].planted_area);
						vm.total.production += parseFloat(val[i].production);
						vm.total.average_yield += parseFloat(val[i].average_yield);
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