<template>
	<div id="dimensions_of_poverties">
		<div class="card rounded-0 bg-light mt-1 shadow-sm">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">The 13+ Dimenstions of Poverty, Oriental Mindoro</h5>
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
						<button class="btn btn-info" @click="updateInfo">Update</button>
					</div>
				</div>
			</div>
		</div>

		<table class="table table-bordered table-light mt-1">
			<thead >
				<tr>
					<th rowspan="3" class="text-center align-middle">Indicator</th>
					<th colspan="2" class="text-center align-middle">Households</th>
					<th colspan="6" class="text-center align-middle">Households</th>
				</tr>
				<tr>
					<th rowspan="2" class="text-center align-middle">Magnitude</th>
					<th rowspan="2" class="text-center align-middle">Proportion</th>
					<th colspan="3" class="text-center align-middle">Magnitude</th>
					<th colspan="3" class="text-center align-middle">Proportion</th>
				</tr>
				<tr>
					<th class="text-center align-middle">Total</th>
					<th class="text-center align-middle">Male</th>
					<th class="text-center align-middle">Female</th>
					<th class="text-center align-middle">Total</th>
					<th class="text-center align-middle">Male</th>
					<th class="text-center align-middle">Female</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="(item, key) in dimensions_of_poverties">
						<tr>
							<td>{{item.indicator}}</td>
							<td class="text-right">{{item.household_magnitude}}</td>
							<td class="text-right">{{item.household_proportion}}</td>
							<td class="text-center">{{item.population_magnitude_total}}</td>
							<td class="text-right">{{item.population_magnitude_male}}</td>
							<td class="text-right">{{item.population_magnitude_female}}</td>
							<td class="text-center">{{item.population_proportion_total}}</td>
							<td class="text-right">{{item.population_proportion_male}}</td>
							<td class="text-right">{{item.population_proportion_female}}</td>
						</tr>
				</template>
			</tbody>
			<tfoot v-if="dimensions_of_poverties.length < 1">
				<tr>
					<td class="text-center" colspan="9">No item found!</td>
				</tr>
			</tfoot>
		</table>
		<div class="row justify-content-end">
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<form @submit.prevent="uploadFile">
							<div class="form-group">
								<label>Select file</label>
								<input type="file" class="form-control-file" @change="imageChanged" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
							</div>
							<div class="form-group">
								<label>Uploading Year</label>
								<v-select  v-model="form.year" :options="defaultYear"></v-select>
								<!-- <select class="form-control" v-model="form.year">
									<option value="" disabled selected>-- Select Year --</option>
									<option v-for="item in defaultYear" :value="item">{{item}}</option>
								</select> -->
							</div>
							<button class="btn btn-primary" type="submit">Submit</button>
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
				dimensions_of_poverties: [],
				year: new Date().getFullYear(),
				token : document.head.querySelector('meta[name="csrf-token"]').content,
				form:{
					cbms: "",
					year: new Date().getFullYear()
				}
			}
		},
		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/social_development/dimensions_of_poverties/get', {year: year})
						.then(data => {
							vm.dimensions_of_poverties = data.data;
							console.log(data.data)
						})
			},
			updateInfo: function()
			{
				var vm = this;
				axios.post('/social_development/dimensions_of_poverties/update', {data: vm.dimensions_of_poverties})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'The 13+ Dimenstions of Poverty, Oriental Mindoro')
						})
			},
			uploadFile: function(){
				var vm = this;
				axios.post('/uploadCBMS', vm.form)
						.then(data => {
							console.log('data');
						})
			},

			imageChanged:function(e)
			{
				for (var i = e.target.files.length - 1; i >= 0; i--) {
					var fileReader = new FileReader();
					fileReader.readAsDataURL(e.target.files[i])
					fileReader.onload = (e) => {
						console.log(e.target)
						this.form.cbms = e.target.result
					}
				}
			},
		},
		mounted: function(){
			this.getInfo();
		},
		watch: {
			year: function(val){
				console.log(val)
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