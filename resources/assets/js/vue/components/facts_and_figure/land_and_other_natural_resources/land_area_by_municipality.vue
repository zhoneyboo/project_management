<template>
	<div id="municipality">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Land Area by City/Municipality</h4>
			</div>
		</div>
		<table class="table table-bordered table-light mt-2">
			<thead class="text-center">
				<tr>
					<th>City/Municipality</th>
					<th>Land Area (sq. km.)</th>
					<th>% to Total</th>
				</tr>
			</thead>
			<tbody>
				<template  v-for="data in municipality">
					<tr>
						<td>{{data.municipality}}</td>
						<td class="text-right">
							{{data.land_area}}
						</td>
						<td class="text-right">
							<currency_label :data="checkNaN(data.percent)"></currency_label>
						</td>
					</tr>
					<tr v-if="data.id == 8" class="bg-secondary text-white">
						<td>Total Land Area (1st District)</td>
						<td class="text-right">
							<h5><currency_label :data="checkNaN(distArr.first.total)"></currency_label></h5>
						</td>
						<td class="text-right">
							<h5><currency_label :data="checkNaN(distArr.first.percent)"></currency_label></h5>
						</td>
					</tr>
					<tr v-if="data.id == 15" class="bg-secondary text-white">
						<td>Total Land Area (2nd District)</td>
						<td class="text-right">
							<h5><currency_label :data="checkNaN(distArr.second.total)"></currency_label></h5>
						</td>
						<td class="text-right">
							<h5><currency_label :data="checkNaN(distArr.second.percent)"></currency_label></h5>
						</td>
					</tr>
				</template>
			</tbody>
		</table>
	</div>
</template>
<script>
	export default{
		props: ['year'],
		data:function(){
			return {
				municipality: [],
				total: 0,
				distArr: {
					first:{
						total: 0,
						percent: 0,
					},
					second: {
						total: 0,
						percent: 0,
					}
				}
			}
		},
		mounted: function(){
			this.getInfo();
		},
		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/land_area_municipality/get', {year: year})
						.then(data => {
							vm.municipality = data.data;
							vm.$forceUpdate();
						})
			},

			checkNaN: function(int){
				if(isNaN(int) || int == undefined || int == null)
				{
					return '0.00';
				}else{
					return int;
				}
			},
		},
		watch: {
			year: function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val)
				}
			},
			municipality:{
				handler: function(val, oldVal){
					var vm = this;
					var municipality = val;
					var total = 0;
					vm.distArr.first.total = 0;
					vm.distArr.second.total = 0;

					vm.distArr.first.percent = 0;
					vm.distArr.second.percent = 0;


					for (var i = municipality.length - 1; i >= 0; i--) {
						total += parseFloat(municipality[i].land_area);

						if(municipality[i].district == 1)
						{
							vm.distArr.first.total += parseFloat(municipality[i].land_area);
						}else if(municipality[i].district == 2)
						{
							vm.distArr.second.total += parseFloat(municipality[i].land_area);
						}
					}

					for (var c = municipality.length - 1; c >= 0; c--) {
						vm.municipality[c]["percent"] = (( parseFloat(municipality[c].land_area) / total )) * 100;

						if(municipality[c].district == 1)
						{
							vm.distArr.first.percent += parseFloat(vm.municipality[c]["percent"]);
						}else if(municipality[c].district == 2)
						{
							vm.distArr.second.percent += parseFloat(vm.municipality[c]["percent"]);
						}
					}

					vm.total = total;
					vm.$forceUpdate();
				},
				deep: true
			}
		}
	}
</script>