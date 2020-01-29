<template>
	<div id="power_substations">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">PRESENT SOURCE OF POWER</h5>
			</div>
		</div>
		<div class="row mt-1">
			<div class="col-md">
				<table class="table table-bordered table-light">
					<thead>
						<tr>
							<th>Power Substations</th>
							<th>Megavolt Amperes (MVA) Rating</th>
							<th>Ownership</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-if="power_substations.length <= 0">
							<td colspan="5" class="text-center">No item found!</td>
						</tr>
						<tr v-for="item in power_substations">
							<td>{{item.power_substation}}</td>
							<td>{{item.megavolt_amperes}}</td>
							<td>{{item.ownership}}</td>
							<td>
								<div class="btn-group">
									<button class="btn btn-primary btn-sm" @click="toggleUpdate(item)">Edit</button>
									<button class="btn btn-danger btn-sm" @click="deleteInfo(item)">Delete</button>
								</div>
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
								<label>Power Substations [ORMECO]</label>
								<input type="text" class="form-control" v-model="form.power_substation">
							</div>

							<div class="form-group">
								<label>Megavolt Amperes (MVA) Rating</label>
								<input type="text" class="form-control" v-model="form.megavolt_amperes">
							</div>

							<div class="form-group">
								<label>Ownership</label>
								<input type="text" class="form-control" v-model="form.ownership">
							</div>
						
							<div class="row justify-content-end">
								<div class="col-auto">
									<button class="btn btn-primary" v-if="!updateInfo" type="submit">Submit</button>
									<button class="btn btn-info" v-if="updateInfo" type="submit">Update</button>
									<button class="btn btn-danger" v-if="updateInfo"  type="submit">Delete</button>
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
					power_substation: '',
					megavolt_amperes: '',
					ownership: '',
					year: new Date().getFullYear(),
				},
				power_substations: [],
				updateInfo: false,
			}
		},
		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/infrustructure_and_utilities/power_substations/get', {year: year})
						.then(data => {
							vm.power_substations = data.data;
						})
			},
			createInfo: function(){
				var vm = this;
				if(!vm.updateInfo)
				{
					axios.post('/infrustructure_and_utilities/power_substations/create', vm.form)
							.then(data => {
								vm.$toastr('success', 'Information is now added!', 'PRESENT SOURCE OF POWER')
								vm.getInfo(vm.form.year);
							})
				}
				else
				{
					axios.post('/infrustructure_and_utilities/power_substations/update', vm.form)
							.then(data => {
								vm.$toastr('success', 'Information is now updated!', 'PRESENT SOURCE OF POWER')
								vm.getInfo(vm.form.year);
							})
				}
				vm.clearForm(vm.form.year);
			},
			toggleUpdate: function(data){
				var vm = this;
				vm.updateInfo = true;
				vm.form = data;
			},
			deleteInfo: function(data){
				var vm = this;
				axios.post('/infrustructure_and_utilities/power_substations/delete', data)
						.then(data => {
							vm.$toastr('success', 'Information is now delete!', 'PRESENT SOURCE OF POWER')
							vm.getInfo(vm.form.year);
						})
			},
			clearForm: function(year){
				var vm = this;
				vm.updateInfo = false;
				vm.form = {
					power_substation: '',
					megavolt_amperes: '',
					ownership: '',
					year: year,
				}
			}
		},
		mounted: function(){
			this.getInfo();
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch: {
			'form.year' :function(val){
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
