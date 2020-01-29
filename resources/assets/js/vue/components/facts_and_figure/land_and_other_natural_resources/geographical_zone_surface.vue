<template>
	<div id="geographical_zone_surface">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Geographical Zone Surfaces</h4>
			</div>
		</div>
		<h5><b>Coastal Areas:</b> {{geographical_zone_surface.coastal_area}}</h5>
		<h5><b>Lakes Areas:</b> {{geographical_zone_surface.lake_areas}}</h5>
		<h5><b>Raparian areas, rich fertile valleys and mountainous areas: </b>{{geographical_zone_surface.total_land_mass}}</h5>
	</div>
</template>

<script>
	export default{
		props: ["year"],
		data:function(){
			return{
				geographical_zone_surface: {
					coastal_area: '',
					lake_areas: '',
					total_land_mass: '',
					year: '',
				},
			}
		},
		mounted: function(){
			this.getInfo();
		},
		methods: {
			getInfo:function(year){
				var vm = this;
				axios.post('/geographical_zone_surface/get', {year: year})
						.then(data => {
							vm.geographical_zone_surface = data.data;
						})
			},
		},

		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch: {
			'year' :function(val)
			{
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			}
		}
	}
</script>