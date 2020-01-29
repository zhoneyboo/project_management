<template>
	<div id="comparative_employment_statuses">
	 	<div class="card rounded-0 bg-light mt-1 shadow-sm">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Comparative Employement Status</h5>
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
					<div class="col">
						<button class="btn btn-primary" @click="addYear">Add new year</button>
						<button class="btn btn-info" @click="updateInfo">Update</button>
					</div>
				</div>
			</div>
		</div>
		<table class="table table-bordered table-light">
			<thead class="text-center">
					<tr>
						<th rowspan="2">Labor and Employment</th>
						<template v-for="year in comparative_employment_statuses['year']">
							<th>{{year}}</th>
						</template>
					</tr>
			</thead>
			<template v-for="(data, key) in comparative_employment_statuses['data']">
				<tr>
					<td>{{key}}</td>
					<template v-for="(year, keyYear) in data">
						<td class="with-input"><currency_input v-model="year.number"></currency_input></td>
					</template>
				</tr>
			</template>
			
			<tbody v-if="comparative_employment_statuses['data'].length <= 0">
				<tr>
					<td>No item added</td>
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
				comparative_employment_statuses: {
						year: [],
						data: [],
					},
			}
		},
		methods:{
			getInfo: function(){
				var vm = this;
				axios.post('/social_development/comparative_employment_statuses/get')
						.then(data => {
							vm.comparative_employment_statuses = data.data;
						})
			},
			addYear: function(){
				var vm = this;
				axios.post('/social_development/comparative_employment_statuses/create', {year: vm.year})
						.then(data => {
							vm.$toastr('success', 'Information is now created!', 'Comparative Employement Status')
							vm.getInfo();
						})
			},
			updateInfo: function(){
				var vm = this;

				axios.post('/social_development/comparative_employment_statuses/udate',{data: vm.comparative_employment_statuses["data"]})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'Comparative Employement Status')

						})
			}
		},
		mounted: function(){
			this.getInfo();
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		}
	}
</script>