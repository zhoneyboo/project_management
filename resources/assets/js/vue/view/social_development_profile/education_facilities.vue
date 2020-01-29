<template>
	<div id="education_facilities">
	 	<div class="card rounded-0 bg-light mt-1 shadow-sm">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Education Facilities</h5>
			</div>
		</div>
		<div class="row mt-1">
			<div class="col-md-8">
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
						<div class="col">
							<button class="btn btn-info" @click="updateInfo">Update</button>
						</div>
					</div>
				</div>
				<table class="table table-light table-bordered">
					<tr>
						<th>Facilities</th>
						<th>Province</th>
						<th>Calapan City</th>
						<th></th>
					</tr>
					<template v-for="item in education_facilities">
						<tr>
							<td>{{item.facilities}}</td>
							<td class="with-input"><currency_input lang="en" v-model="item.province"></currency_input></td>
							<td class="with-input"><currency_input v-model="item.calapan"></currency_input></td>
							<td width="10%">
								<button class="btn btn-danger btn-sm" @click="deleteInfo(item.id)">Remove</button>
							</td>
						</tr>
					</template>
					<tfoot v-if="education_facilities.length <= 0">
						<tr>
							<td colspan="4" class="text-center">No item added!</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<div class="form-group">
							<label>Facilities</label>
							<input type="text" class="form-control" v-model="form.facilities">
						</div>
						<div class="row justify-content-end">
							<div class="col-auto">
								<button class="btn btn-primary" @click="addInfo">Add Facility</button>
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
				education_facilities: [],
				form: {
					facilities: '',
					year: new Date().getFullYear(),
				}
			}
		},
		methods:{
			getInfo: function(year){
				var vm = this;
				if(year == "")
				{
					axios.post('/social_development/education_facilities/get')
						.then(data => {
							vm.education_facilities = data.data;
						})
					}else{
						axios.post('/social_development/education_facilities/get', {year: year})
						.then(data => {
							vm.education_facilities = data.data;
						})
					}
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/social_development/education_facilities/update', {data: vm.education_facilities})
					.then(data => {
						vm.$toastr('success', 'Information is now updated!', 'Education Facilities')
							vm.getInfo(vm.year);
						})
			},
			addInfo: function(){
				var vm = this;
				vm.form.year = vm.year;
				axios.post('/social_development/education_facilities/create', vm.form)
						.then(data => {
						vm.$toastr('success', 'Information is now created!', 'Education Facilities')
							vm.getInfo(vm.year);
						})
			},
			deleteInfo: function(id)
			{
				var vm = this;
				axios.post('/social_development/education_facilities/delete', {id: id})
					.then(data => {
						vm.$toastr('success', 'Information is now removed!', 'Education Facilities')
						vm.getInfo(vm.year);
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
					this.getInfo(val)
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