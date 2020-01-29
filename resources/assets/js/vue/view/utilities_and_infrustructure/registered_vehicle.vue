<template>
	<div id="registered_vehicle">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Registered Vechicle</h5>
					<!-- <small><b>Source:</b> Provincial Environment and Natural Resources Office, 2017</small> -->
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


			<table class="table table-bordered table-light mt-1">
				<thead>
					<tr>
						<th>Registered Motor Vehicles</th>
						<th width="10%">Cars</th>
						<th width="10%">SUV, UV</th>
						<th width="10%">Tricycles</th>
						<th width="10%">Truck</th>
						<th width="10%">Truck Bus</th>
						<th width="10%">Motorcycle/ Motorcycle with Sidecar</th>
						<th width="10%">UV Jeepney</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="item in registered_vechicle">
						<td>{{item.month}}</td>
						<td class="with-input">
							<currency_input v-model="item.cars"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.suv_uv"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.tricycle"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.truck"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.truck_bus"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.motorcycle"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.uv_jeep"></currency_input>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>TOTAL</th>
						<th>{{total.cars}}</th>
						<th>{{total.suv_uv}}</th>
						<th>{{total.tricycle}}</th>
						<th>{{total.truck}}</th>
						<th>{{total.truck_bus}}</th>
						<th>{{total.motorcycle}}</th>
						<th>{{total.uv_jeep}}</th>
					</tr>
				</tfoot>
			</table>
	</div>
</template>
<script>
	export default{
		data: function(){
			return {
				registered_vechicle: [],
				year: new Date().getFullYear(),
				total:{
					cars: 0,
					suv_uv: 0,
					tricycle: 0,
					truck: 0,
					truck_bus: 0,
					motorcycle: 0,
					uv_jeep: 0,
				}
			}
		},
		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch: {
			year: function(val)
			{
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			},
			registered_vechicle: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total.cars = 0;
					vm.total.suv_uv = 0;
					vm.total.tricycle = 0;
					vm.total.truck = 0;
					vm.total.truck_bus = 0;
					vm.total.motorcycle = 0;
					vm.total.uv_jeep = 0;

					for (var i = val.length - 1; i >= 0; i--) {
						vm.total.cars += parseFloat(val[i]['cars']);
						vm.total.suv_uv += parseFloat(val[i]['suv_uv']);
						vm.total.tricycle += parseFloat(val[i]['tricycle']);
						vm.total.truck += parseFloat(val[i]['truck']);
						vm.total.truck_bus += parseFloat(val[i]['truck_bus']);
						vm.total.motorcycle += parseFloat(val[i]['motorcycle']);
						vm.total.uv_jeep += parseFloat(val[i]['uv_jeep']);
					}
				},	
				deep: true,
			}
		},
		methods:{
			getInfo:function(year)
			{
				var vm =this;
				axios.post('/infrustructure_and_utilities/registered_vechicle/get', {year: year})
					.then(data => {
						vm.registered_vechicle = data.data;
					})
			},
			updateInfo: function(){
				var vm =this;
				axios.post('/infrustructure_and_utilities/registered_vechicle/update', {data: vm.registered_vechicle})
					.then(data => {
						vm.$toastr('success', 'Information is now updated!', 'Registered Vehicles')
					})
				
			}
		},
		mounted:function(){
			this.getInfo();
		}
	}
</script>