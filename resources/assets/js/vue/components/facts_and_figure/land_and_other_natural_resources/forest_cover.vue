<template>
	<div id="forest_covers">
		
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Forest Cover</h4>
			</div>
		</div>
		<table class="table table-bordered table-light">
			<thead>
				<tr>
					<th>Province</th>
					<th>Closed Forest</th>
					<th>Open Forest</th>
					<th>Mangrove</th>
					<th>Total Forest</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="item in forest_covers">
					<tr>
						<td>{{item.province}}</td>
						<td>{{item.closed_forest}}</td>
						<td>{{item.open_forest}}</td>
						<td>{{item.mangrove}}</td>
						<td class="text-right">
							{{
								parseFloat(item.closed_forest) +
								parseFloat(item.open_forest) +
								parseFloat(item.mangrove)
							}}
						</td>
					</tr>
				</template>
			</tbody>
			<tfoot>
				<tr>
					<th>MIMAROPA</th>
					<th class="text-right">
						<currency_label :data
						="total.closed_forest"></currency_label>
					</th>
					<th class="text-right">
						<currency_label :data
						="total.open_forest"></currency_label>
					</th>
					<th class="text-right">
						<currency_label :data
						="total.mangrove"></currency_label>
					</th>
					<th class="text-right">
							<currency_label :data="parseFloat(total.closed_forest) +
							parseFloat(total.open_forest) +
							parseFloat(total.mangrove)"></currency_label>
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
				forest_covers: [],
				total: {
					closed_forest: 0,
					open_forest: 0,
					mangrove: 0,
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
				axios.post('/land_and_natural_resources/forest_covers/get', {year: year})
						.then(data => {
							vm.forest_covers = data.data;
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
			forest_covers: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total = {
								closed_forest: 0,
								open_forest: 0,
								mangrove: 0,
							};

					for (var i = 0; i < val.length; i++) {
						vm.total.closed_forest += parseFloat(val[i].closed_forest);
						vm.total.open_forest += parseFloat(val[i].open_forest);
						vm.total.mangrove += parseFloat(val[i].mangrove);
					}
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