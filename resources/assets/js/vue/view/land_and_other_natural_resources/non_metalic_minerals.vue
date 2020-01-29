<template>
	<div id="non_metallic_minerals">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Non-Metallic Minerals</h5>
					<small><b>Source:</b> Provincial Treasury Office, 2017 </small>
				</div>
			</div>
			
			<div class="container mt-1">
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
			<table class="table table-light mt-1">
				<thead>
					<tr>
						<th>City/Municipality</th>
						<th>Total (cu.m.)</th>
						<th>Total Value (Php)</th>
					</tr>
				</thead>
				<tbody>
					<template  v-for="data in non_metallic_minerals">
						<tr>
							<td>{{data.municipality}}</td>
							<td class="with-input">
								<currency_input v-model="data.cubic_meter"></currency_input>
							</td>
							<td class="with-input">
								<currency_input v-model="data.amount"></currency_input>
							</td>
						</tr>
						<tr v-if="data.municipality_id == 8" class="bg-secondary text-white">
							<td>1st District Total</td>
							<td>{{d1_total_cubic_meter}}</td>
							<td>{{d1_total_amount}}</td>
						</tr>
						<tr v-if="data.municipality_id == 15" class="bg-secondary text-white">
							<td>2nd District Total</td>
							<td>{{d2_total_cubic_meter}}</td>
							<td>{{d2_total_amount}}</td>
						</tr>
					</template>
				</tbody>
			</table>
	</div>
</template>

<script>
	export default{
		data:function(){
			return {
				non_metallic_minerals: {
					municipality:
					 '',
					cubic_meter: '',
					amount: '',
					year: new Date().getFullYear(),
				},
				d1_total_cubic_meter: 0,
				d1_total_amount: 0,
				d2_total_cubic_meter: 0,
				d2_total_amount: 0,
				year: new Date().getFullYear()
			}
		},
		watch: {
			non_metallic_minerals: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.d1_total_cubic_meter = 0;
					vm.d1_total_amount = 0;

					vm.d2_total_cubic_meter = 0;
					vm.d2_total_amount = 0;

					for (var i = val.length - 1; i >= 0; i--) {
						if(val[i]["district"] == 1)
						{
							vm.d1_total_cubic_meter += parseFloat(val[i]["cubic_meter"]);
							vm.d1_total_amount += parseFloat(val[i]["amount"])
						}
						if(val[i]["district"] == 2)
						{
							vm.d2_total_cubic_meter += parseFloat(val[i]["cubic_meter"]);
							vm.d2_total_amount += parseFloat(val[i]["amount"])
						}
					}
					vm.$forceUpdate();
					console.log("hello")
				},
				deep: true
			},
			year: function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			}
		},
		mounted: function(){
			this.getInfo();
		},
		methods:{
			getInfo: function(year){
				var vm = this;

				axios.post('/non_metallic_minerals/get', {year: year})
						.then(data => {
							vm.non_metallic_minerals = data.data;
						})
			},
			updateInfo: function()
			{
				var vm = this;
				axios.post('/non_metallic_minerals/update', {data: vm.non_metallic_minerals})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'Non-Metallic Minerals')
						})
			}
		},
		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
	}
</script>