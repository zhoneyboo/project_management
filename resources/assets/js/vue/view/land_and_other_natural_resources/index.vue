<template>
	<div id="LAND_AND_OTHER_NATURAL_RESOURCES">
		<div class="header">
			<div class="card rounded-0 shadow-sm">
				<div class="card-body p-3">
					<h5 class="font-weight-bold text-uppercase">Land and Natural Resources</h5>
					<small>Note: This list all Provincial Governement of Oriental Mindoro General Information.</small>
				</div>
			</div>
			<div class="dropdown">
				<a class="btn btn-secondary dropdown-toggle rounded-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				   Land and Natural Resources link
				 </a>
				<div class="dropdown-menu">
					<router-link class="dropdown-item" :to="{name: 'land_and_other_natural_resources'}">Land Area by City/Municipality</router-link>
					<router-link class="dropdown-item" :to="{name: 'land_classification_statistic'}">Land Classification Statistics</router-link>
					<router-link class="dropdown-item" :to="{name: 'geographical_zone_surface'}">Geographical Zone Surfaces</router-link>
					<router-link class="dropdown-item" :to="{name: 'metallic_mineral_resources'}">Location of Metallic Mineral Resources</router-link>
					<router-link class="dropdown-item" :to="{name: 'non_metalic_minerals'}">Minerals Resources</router-link>
					<router-link class="dropdown-item" :to="{name: 'forest_covers'}">Forest Cover</router-link>
					<router-link class="dropdown-item" :to="{name: 'major_watershed'}">Major Watersheds</router-link>
					<router-link class="dropdown-item" :to="{name: 'marine_protected_areas'}">Marine Protected Areas</router-link>
					<router-link class="dropdown-item" :to="{name: 'established_marine_protected_areas'}">Established Marine Protected Areas</router-link>
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