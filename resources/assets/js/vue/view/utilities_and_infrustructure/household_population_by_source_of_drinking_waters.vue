<template>
	<div id="household_population_by_source_of_drinking_waters">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Household Population by Source of Drinking Water</h5>
			</div>
		</div>
		<div class="row mt-1">
			<div class="col-md">
				<table class="table table-bordered table-light">
					<thead class="text-center">
						<tr>
							<th rowspan="2" class="align-middle">Source of Drinking Water</th>
							<th colspan="3">Household Population</th>
						</tr>
						<tr>
							<th>Magnitude*</th>
							<th>Proportion**</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="item in household_population_by_source_of_drinking_waters">
							<td>{{item.source_of_drinking}}</td>
							<td>{{item.magnitude}}</td>
							<td>{{item.proportion}}</td>
							<td width="10%">
								<div class="btn-group">
									<button class="btn btn-sm btn-primary" @click="toggleUpdate(item)">Update</button>
									<button class="btn btn-sm btn-danger" @click="deleteInfo(item)">Delete</button>
								</div>
							</td>
						</tr>
						<tr v-if="household_population_by_source_of_drinking_waters.length <= 0">
							<td colspan="4" class="text-center">
								No item found
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<form @submit.prevent="createInfo">
							<div class="form-group">
								<label>Year of Encoding</label>
								<v-select  v-model="form.year" :options="defaultYear"></v-select>
								<!-- <select class="form-control" v-model="form.year">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select> -->
							</div>
							
							<div class="form-group">
								<label>Source of Drinking Water</label>
								<input type="text" class="form-control" v-model="form.source_of_drinking">
							</div>
							<div class="form-group">
								<label>House Population Magnitude</label>
								<currency_input class="form-control" v-model="form.magnitude"></currency_input>
							</div>
							<div class="form-group">
								<label>House Population Proportion **</label>
								<currency_input class="form-control" v-model="form.proportion"></currency_input>
							</div>
							<div class="row justify-content-end">
								<div class="col-auto">
									<button class="btn btn-primary" v-if="!updateInfo" type="submit">Submit</button>
									<button class="btn btn-info" v-if="updateInfo" type="submit">Update</button>
									<button class="btn btn-danger" v-if="updateInfo" type="button">Cancel</button>
								</div>
							</div>
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
				form: {
					source_of_drinking: '',
					magnitude: '',
					proportion: '',
					year: new Date().getFullYear(),
				},
				updateInfo: false,
				household_population_by_source_of_drinking_waters: []
			}
		},
		mounted: function(){
			this.getInfo();
		},

		methods: {
			clearForm: function(year){
				this.form =  {
					source_of_drinking: '',
					magnitude: '',
					proportion: '',
					year: year,
				}
				this.updateInfo = false;
			},
			getInfo: function(year){
				var vm = this;
				axios.post('/infrustructure_and_utilities/household_population_by_source_of_drinking_waters/get',{year:year})
					.then(data => {
						vm.household_population_by_source_of_drinking_waters = data.data;
					})
			},
			createInfo: function(){
				var vm = this;
				if(vm.updateInfo == false)
				{
					axios.post('/infrustructure_and_utilities/household_population_by_source_of_drinking_waters/create', vm.form)
						.then(data => {
							vm.$toastr('success', 'Information is now create!', 'Household Population by Source of Drinking Water')
							vm.getInfo(vm.form.year);
						})
				}else
				{
						axios.post('/infrustructure_and_utilities/household_population_by_source_of_drinking_waters/update', vm.form)
						.then(data => {
							vm.$toastr('success', 'Information is now update!', 'Household Population by Source of Drinking Water')
							vm.getInfo(vm.form.year);
						})
				}
				this.clearForm(vm.form.year);
			},
			toggleUpdate: function(data){
				this.form = data;
				this.updateInfo = true;
			},
			deleteInfo: function(data){
				var vm = this;
				axios.post('/infrustructure_and_utilities/household_population_by_source_of_drinking_waters/delete', data)
						.then(data => {
							vm.$toastr('success', 'Information is now removed!', 'Household Population by Source of Drinking Water')
							vm.getInfo(vm.form.year);
						})
			}
		},
		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch: {
			'form.year': function(val){
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