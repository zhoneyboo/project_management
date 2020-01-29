<template>
	<div id="registered_vehicle">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Registered Vechicle</h4>
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
					<td class="text-right">{{item.cars}}</td>
					<td class="text-right">{{item.suv_uv}}</td>
					<td class="text-right">{{item.tricycle}}</td>
					<td class="text-right">{{item.truck}}</td>
					<td class="text-right">{{item.truck_bus}}</td>
					<td class="text-right">{{item.motorcycle}}</td>
					<td class="text-right">{{item.uv_jeep}}</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<th>TOTAL</th>
					<th class="text-right">{{total.cars}}</th>
					<th class="text-right">{{total.suv_uv}}</th>
					<th class="text-right">{{total.tricycle}}</th>
					<th class="text-right">{{total.truck}}</th>
					<th class="text-right">{{total.truck_bus}}</th>
					<th class="text-right">{{total.motorcycle}}</th>
					<th class="text-right">{{total.uv_jeep}}</th>
				</tr>
			</tfoot>
		</table>
	</div>
</template>
<script>
	export default{
		props: ["year"],
		data: function(){
			return {
				registered_vechicle: [],
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

					})
				
			}
		},
		mounted:function(){
			this.getInfo();
		}
	}
</script>