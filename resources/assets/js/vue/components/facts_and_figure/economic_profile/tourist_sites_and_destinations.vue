<template>
	<div id="tourist_sites_and_destinations">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">TOURIST SITES AND DESTINATIONS</h4>
			</div>
		</div>
		<table class="table table-bordered table-light">
			<template v-for="(data, municipality) in tourist_sites_and_destinations">
				<thead>
					<tr>
						<th>{{municipality}}</th>
					</tr>
				</thead>
				<template v-for="item in data">
					<tbody>
						<tr>
							<td>
								{{item.destination}}
							</td>
						</tr>
					</tbody>
				</template>
			</template>
		</table>
	</div>
</template>
<script>
	export default{
		data: function(){
			return {
				tourist_sites_and_destinations: [],
			}
		},
		methods:{
			getInfo: function()
			{
				var vm = this;
				axios.post('/economic_profile/tourist_sites_and_destinations/get')
						.then(data => {
							vm.tourist_sites_and_destinations = data.data;
						})
			},
		},
		computed: {

		},
		mounted: function(){
			this.getInfo();
		}
	}
</script>