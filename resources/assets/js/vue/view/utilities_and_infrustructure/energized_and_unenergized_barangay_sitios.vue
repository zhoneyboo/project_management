
<template>
	<div id="energized_and_unenergized_barangay_sitios">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Energized and Unenergized Barangay and Sitios in Oriental Mindoro</h5>
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
			<table class="table table-bordered table-light">
				<thead>
					<tr>
						<th>City/Municipality</th>
						<th>Potential</th>
						<th>Energized</th>
						<th>Percent</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="item in energized_and_unenergized_barangay_sitios">
						<tr v-if="item.municipality == 1" class="bg-secondary text-white">
							<td colspan="9">1st District</td>
						</tr>
						<tr v-if="item.municipality == 9" class="bg-secondary text-white">
							<td colspan="9">2nd District</td>
						</tr>
						<tr>
							<td>{{item.municipality_name}}</td>
							<td class="with-input">
								<currency_input v-model="item.potential"></currency_input>
							</td>
							<td class="with-input">
								<currency_input v-model="item.energized"></currency_input>
							</td>
							<td width="15%" class="text-right">
								<span>{{item.barangay_percent.toFixed(2)}} %</span>
							</td>
						</tr>
					</template>
				</tbody>
				<tfoot>
					<tr>
						<th>Oriental Mindoro</th>
						<td>{{total.potential}}</td>
						<td>{{total.energized}}</td>
						<td>{{total.percent.toFixed(2)}} %</td>
					</tr>
				</tfoot>
			</table>
	</div>
</template>

<script>
	export default{
		data: function(){
			return {
				year: new Date().getFullYear(),
				energized_and_unenergized_barangay_sitios: [],
				total: {
					potential: 0,
					energized: 0,
					percent: 0,
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
				axios.post('/infrustructure_and_utilities/energized_and_unenergized_barangay_sitios/get', {year: year})
						.then(data => {
							vm.energized_and_unenergized_barangay_sitios = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/infrustructure_and_utilities/energized_and_unenergized_barangay_sitios/update', {data: vm.energized_and_unenergized_barangay_sitios})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'Energized and Unenergized Barangay and Sitios in Oriental Mindoro')
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
			energized_and_unenergized_barangay_sitios:{
				handler: function(val)
				{
					var vm = this;
					vm.total.potential = 0;
					vm.total.energized = 0;
					vm.total.percent = 0;
					for (var i = val.length - 1; i >= 0; i--) {

						var barangay_percent = (parseFloat(val[i]["energized"]) / parseFloat(val[i]["potential"])) * 100;

						if(isNaN(barangay_percent))
						{
							barangay_percent = 0;
						}
						val[i]["barangay_percent"] = barangay_percent ;
						vm.total.potential += parseFloat(val[i].potential);
						vm.total.energized += parseFloat(val[i].energized);
					}
					vm.total.percent = (parseFloat(vm.total.energized) / parseFloat(vm.total.potential)) *100
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