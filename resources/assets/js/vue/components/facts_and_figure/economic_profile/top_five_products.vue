<template>
	<div id="top_five_products">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Top Five Production by City/Muncipality</h4>
			</div>
		</div>
		<table class="table table-bordered table-light">
			<thead>
				<tr>
					<th rowspan="2" class="text-center">Municipality</th>
					<template v-if="top_five_products.product_name">
						<th :colspan="length_info" class="text-center">Production (MT)</th>
					</template>
				</tr>
				<tr>
					<template v-for="(data, index) in top_five_products.product_name">
						<th class="text-center">{{index}}</th>
					</template>
				</tr>
			</thead>
			<tbody>
				<template v-for="(data, municipality) in top_five_products.data">

					<tr v-if="municipality == 'Baco'">
						<td :colspan="length_info + 1">1st District</td>
					</tr>
					<tr v-if="municipality == 'Bansud'">
						<td :colspan="length_info + 1">2nd District</td>
					</tr>
					<tr>
						<td>{{municipality}}</td>
						<template v-for="item in data">
							<td class="text-right">{{item.quantity}}</td>
						</template>
					</tr>
				</template>
			</tbody>
		</table>
	</div>
</template>
<script>
	export default{
		props: ["year"],
		data: function(){
			return {
				form: {
					product: '',
					year: '',
				},
				top_five_products: [],
				lenth_info: 0,
			}
		},
		mounted: function(){
			this.getInfo();
		},
		methods: {
			getInfo: function(year){
				var vm = this;
				axios.post('/economic_profile/top_five_products/get', {year: year})
						.then(data => {
							vm.top_five_products = data.data;
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
			top_five_products: {
				handler: function(val, oldVal)
				{
					var length_info = 0;
					for(var product in val.product_name)
					{
						length_info += 1;
					}
					this.length_info = length_info;
				},
				deep: true
			}
		},
	}
</script>
