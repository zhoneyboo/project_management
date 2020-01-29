<template>
	<div id="health_infant_morbidities" >
	 	<div class="card rounded-0 bg-light mt-1 shadow-sm">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Infant Morbidity: Leading Causes, Number and Rate per 100,000 Population Comparative Five Year Average</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
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
							<div class="col">
								<button class="btn btn-info" @click="updateInfo">Update</button>
							</div>
						</div>
					</div>
				</div>
				<table class="table table-light table-bordered mt-1">
					<thead>
						<tr>
							<th rowspan="2">Causes</th>
							<th colspan="2">{{year}}</th>
							<th colspan="2">5-Year Average</th>
							<th rowspan="2" width="10%"></th>
						</tr>
						<tr>
							<th>No.</th>
							<th>Rate</th>
							<th>No.</th>
							<th>Rate</th>
						</tr>
					</thead>
					<tbody>
						<tr v-if="health_infant_morbidities.length <= 0">
							<td colspan="5">No item found</td>
						</tr>
						<template v-for="item in health_infant_morbidities">
							<tr>
								<td>{{item.cause}}</td>
								<td class="with-input">
									<currency_input v-model="item.year_no"></currency_input>
								</td>
								<td class="with-input">
									<currency_input v-model="item.year_rate"></currency_input>
								</td>
								<td class="with-input">
									<currency_input v-model="item.five_year_no"></currency_input>
								</td>
								<td class="with-input">
									<currency_input v-model="item.five_year_rate"></currency_input>
								</td>
								<td>
									<button class="btn btn-danger btn-sm" @click="deleteInfo(item.id)">remove</button>
								</td>
							</tr>
						</template>
					</tbody>
				</table>
			</div>
			<div class="col-md-4" v-if="year != ''">
				<div class="card">
					<div class="card-body">
						<p>Add Cause</p>
						<div class="form-group">
							<label>Cause</label>
							<input type="text" class="form-control" v-model="form.cause">
						</div>
						<button class="btn btn-primary" @click="addInfo">Add</button>
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
				health_infant_morbidities: [],
				form: {
					cause: '',
					year: new Date().getFullYear(),
				}
			}
		},
		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/social_development/health_infant_morbidities/get', {year: year})
						.then(data => {
							vm.health_infant_morbidities = data.data;
						})

			},
			updateInfo: function(){
				var vm = this;
				axios.post('/social_development/health_infant_morbidities/update', {data: vm.health_infant_morbidities})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'Infant Morbidity: Leading Causes, Number and Rate per 100,000 Population Comparative Five Year Average')
							vm.getInfo(vm.year);
						})

			},
			addInfo: function(){
				var vm = this;
				vm.form.year = vm.year;

				axios.post('/social_development/health_infant_morbidities/create', vm.form)
						.then(data => {
							vm.$toastr('success', 'Information is now created!', 'Infant Morbidity: Leading Causes, Number and Rate per 100,000 Population Comparative Five Year Average')
							vm.getInfo(vm.year);
						})
			},
			deleteInfo: function(id){
				var vm = this;
				axios.post('/social_development/health_infant_morbidities/delete', {id: id})
						.then(data => {
							vm.$toastr('success', 'Information is now removed!', 'Infant Morbidity: Leading Causes, Number and Rate per 100,000 Population Comparative Five Year Average')
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