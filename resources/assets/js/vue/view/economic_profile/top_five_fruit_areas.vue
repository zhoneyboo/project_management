
<template>
	<div id="top_five_fruit_areas">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Top Five Fruit by Area</h5>
			</div>
		</div>
		<div class="row mt-1">
			<div class="col-md">
				<div class="container">
						<div class="row">
							<div class="col-4 col-md-4 col-lg-4 col-xl-4 ml-auto pr-1">
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
				<table class="table table-bordered table-light  mt-1">
					<thead>
						<tr>
							<th rowspan="2">Municipality</th>
							<th :colspan="length_info">Production (MT)</th>
						</tr>
						<tr>
							<template v-for="(data, index) in top_five_fruit_areas.product_name">
								<th>{{index}} <button class="btn btn-danger btn-sm" @click="removeInfo(index)">x</button></th>
							</template>
						</tr>
					</thead>
					<tbody>
						<template v-for="(data, municipality) in top_five_fruit_areas.data">

							<tr v-if="municipality == 'Baco'">
								<td :colspan="length_info + 1">1st District</td>
							</tr>
							<tr v-if="municipality == 'Bansud'">
								<td :colspan="length_info + 1">2nd District</td>
							</tr>
							<tr>
								<td>{{municipality}}</td>
								<template v-for="item in data">
									<td class="with-input">
										<currency_input v-model="item.quantity"></currency_input>
									</td>
								</template>
							</tr>
						</template>
					</tbody>
					<template v-if="top_five_fruit_areas.data.length <= 0">
							<tr>
								<td colspan="2">
									No item found
								</td>
							</tr>
						</template>
						<tfoot>
							<sum_of_object :data="top_five_fruit_areas.data"></sum_of_object>
					</tfoot>
				</table>
			</div>
			<div class="col-md-4" v-if="year != ''">
				<div class="card">
					<div class="card-body">
						<p>ADD FRUIT FORM</p>
						<div class="form-group">
							<label>Add Fruit</label>
							<input type="text" class="form-control" v-model="form.product">
						</div>
						<button class="btn btn-primary" @click="createInfo">Add Fruit</button>
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
				form: {
					product: '',
					year: '',
				},
				top_five_fruit_areas: [],
				length_info: 0,
			}
		},
		mounted: function(){
			this.getInfo();
		},
		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/economic_profile/top_five_fruit_areas/get', {year: year})
						.then(data => {
							vm.top_five_fruit_areas = data.data;
							console.log(vm.top_five_fruit_areas)
						})
			},
			createInfo: function(){
				var vm = this;
				vm.form.year = this.year;
				axios.post('/economic_profile/top_five_fruit_areas/create', vm.form)
						.then(data => {
							vm.getInfo(vm.form.year)
							vm.$toastr('success', 'Information is now added!', 'Top Five Fruit by City/Muncipality')
							vm.form.product = "";
						})

			},
			updateInfo: function(){
				var vm = this;
				axios.post('/economic_profile/top_five_fruit_areas/update', {data: vm.top_five_fruit_areas.data})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'Top Five Fruit by City/Muncipality')
						})
			},
			removeInfo: function(product)
			{
				var vm = this;
				axios.post('/economic_profile/top_five_fruit_areas/delete', {product: product, year: vm.top_five_fruit_areas.year})
						.then(data => {
							vm.$toastr('success', 'Information is now removed!', 'Top Five Fruit by City/Muncipality')
							vm.getInfo(vm.top_five_fruit_areas.year)
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

			top_five_fruit_areas: {
				handler: function(val, oldVal)
				{
					var length_info = 0;
					for(var product in val.product_name)
					{
						length_info += 1;
					}
					console.log(length_info)
					this.length_info = length_info;
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
