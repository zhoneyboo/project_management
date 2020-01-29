<template>
	<div id="accommodation_establishments">
		<div class="card bg-info">
				<div class="card-body pl-3 pr-3 pt-2 pb-2">
					<h4 class="font-weight-bold text-uppercase text-white">Oriental Mindoro Accomodation Establishment</h4>
				</div>
			</div>
		<table class="table table-bordered table-light">
			<thead>
				<tr>
					<th>City/Municipality</th>
					<th>No. of <br>Accommodation<br> Establishments</th>
					<th>No. of Rooms</th>
					<th>Bedding Capacity</th>
					<th>Total Employment</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="item in accommodation_establishments">
					<tr v-if="item.municipality == 1" class="bg-secondary text-white">
						<td colspan="5">1st District</td>
					</tr>
					<tr v-if="item.municipality == 9" class="bg-secondary text-white">
						<td colspan="5">2nd District</td>
					</tr>
					<tr>
						<td>{{item.municipality_name}}</td>
						<td class="text-right">
							<currency_label :data="item.no_of_accommodation_establishment"></currency_label>
						</td>
						<td class="text-right">
							<currency_label :data="item.no_of_room"></currency_label>
						</td>
						<td class="text-right">
							<currency_label :data="item.bedding_capacity"></currency_label>
						</td>
						<td class="text-right">
							<currency_label :data="item.total_employment"></currency_label>
						</td>
					</tr>
				</template>
			</tbody>
			<tfoot>
				<tr>
					<th>ORIENTAL MINDORO</th>
					<th class="text-right">
						<currency_label :data="total.no_of_accommodation_establishment"></currency_label>
					</th>
					<th class="text-right">
						<currency_label :data="total.no_of_room"></currency_label>
					</th>
					<th class="text-right">
						<currency_label :data="total.bedding_capacity"></currency_label></th>
					<th class="text-right">
						<currency_label :data="total.total_employment"></currency_label>
					</th>
				</tr>
			</tfoot>
		</table>
	</div>
</template>

<script>
	export default{
		props:["year"],
		data: function(){
			return {
				accommodation_establishments: [],
				total: {
					no_of_accommodation_establishment: 0,
					no_of_room: 0,
					bedding_capacity: 0,
					total_employment: 0,
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
				axios.post('/economic_profile/accommodation_establishments/get', {year: year})
						.then(data => {
							vm.accommodation_establishments = data.data;
						})
			},
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
			accommodation_establishments: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total.no_of_accommodation_establishment = 0;
					vm.total.no_of_room = 0;
					vm.total.bedding_capacity = 0;
					vm.total.total_employment = 0;

					for (var i = 0; i < val.length; i++) {
						vm.total.no_of_accommodation_establishment += parseFloat(val[i].no_of_accommodation_establishment);
						vm.total.no_of_room += parseFloat(val[i].no_of_room);
						vm.total.bedding_capacity += parseFloat(val[i].bedding_capacity);
						vm.total.total_employment += parseFloat(val[i].total_employment);
					}
				},
				deep: true
			}
		},
	}
</script>