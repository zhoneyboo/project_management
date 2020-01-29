<template>
	<div id="economic_profile">
		<div class="header">
			<div class="card rounded-0 shadow-sm">
				<div class="card-body p-3">
					<h5 class="font-weight-bold">ECONOMIC PROFILE</h5>
					<small>Note: This list all Provincial Governement of Oriental Mindoro General Information.</small>
				</div>
			</div>

			<div class="dropdown">
				<a class="btn btn-secondary dropdown-toggle rounded-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  	Economic Profile
				 </a>
				<div class="dropdown-menu">
					<router-link :to="{name:'rice_area_city'}" class="dropdown-item">Rice Area By City</router-link>
					<router-link :to="{name:'irrigated_area'}" class="dropdown-item">Irrigated Area By Type</router-link>
					<router-link :to="{name:'rice_production'}" class="dropdown-item">Rice Production</router-link>
					<router-link :to="{name:'corn_production'}" class="dropdown-item">Corn Production</router-link>
					<router-link :to="{name:'vegetable_production'}" class="dropdown-item">Vegetable Production</router-link>
					<router-link :to="{name:'coconut_production'}" class="dropdown-item">Coconut Production</router-link>
					<router-link :to="{name:'high_value_commercial_crops'}" class="dropdown-item">High Value Crops</router-link>
					<router-link :to="{name:'accommodation_establishments'}" class="dropdown-item">Accommodation Establishments</router-link>
					<router-link :to="{name:'tourist_sites_and_destinations'}" class="dropdown-item">Tourist Sites and Destinations</router-link>
					<router-link :to="{name:'number_of_banks_and_atm'}" class="dropdown-item">Number of Banks and ATMs</router-link>
					<router-link :to="{name:'commerce_and_industry'}" class="dropdown-item">Commerce and Industry</router-link>

					<router-link :to="{name:'top_five_product'}" class="dropdown-item">Top 5 Fruit Area Harvested</router-link>
					<router-link :to="{name:'top_five_fruit_areas'}" class="dropdown-item">Top 5 Fruit By Area</router-link>
				</div>
			</div>
			<div class="content">
				<router-view></router-view>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		data: function(){
			return {
				selected_name: 'Social Development Link',
			}
		},
		methods: {

			changeLink: function(name, link){
				this.$router.push({name: link});
			}

		},
		mounted: function(){
			this.selected_name = 'Social Development Link';
		}

	}
</script>