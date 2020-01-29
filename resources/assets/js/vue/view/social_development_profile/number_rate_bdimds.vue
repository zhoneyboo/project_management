<template>
	<div id="number_rate_bdimds" >
	 	<div class="card rounded-0 bg-light mt-1 shadow-sm">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Number of Rate of Births (House Hold Population by Sex)</h5>
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
						<th rowspan="2">Municipality</th>
						<template v-for="year in number_rate_bdimds['year']">
							<th colspan="2">{{year}}</th>
						</template>
					</tr>
					<tr>
						<template v-for="years in number_rate_bdimds['year']">
							<th>No.</th>
							<th>Rate</th>
						</template>
					</tr>
			</thead>
			<template v-for="(data, key) in number_rate_bdimds['data']">
				<tr>
					<td>{{key}}</td>
					<template v-for="(year, keyYear) in data">
						<td class="with-input">
							<currency_input v-model="year.number"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="year.rate"></currency_input>
						</td>
					</template>
				</tr>
			</template>
			<tbody v-if="number_rate_bdimds['data'].length <= 0">
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
				number_rate_bdimds: {
						year: [],
						data: [],
					},
			}
		},
		methods:{
			getInfo: function(){
				var vm = this;
				axios.post('/social_development/number_rate_bdimds/get')
						.then(data => {
							vm.number_rate_bdimds = data.data;
							vm.$forceUpdate();
						})
			},
			addYear: function(){
				var vm = this;
				axios.post('/social_development/number_rate_bdimds/create', {year: vm.year})
						.then(data => {
							vm.getInfo();
						})
			},
			updateInfo: function(){
				var vm = this;

				axios.post('/social_development/number_rate_bdimds/udate',{data: vm.number_rate_bdimds["data"]})
						.then(data => {

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