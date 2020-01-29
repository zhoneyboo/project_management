<template>
	<div class="demograph">
		<div class="header">
			<div class="card rounded-0 shadow-sm">
				<div class="card-body p-3">
					<h5 class="font-weight-bold">Demograph</h5>
					<small>Note: This list all Provincial Governement of Oriental Mindoro General Information.</small>
				</div>
			</div>
			<div class="dropdown">
				<a class="btn btn-secondary dropdown-toggle rounded-0" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				   Demograph Links
				 </a>
				<div class="dropdown-menu">
					<router-link class="dropdown-item" :to="{name:'ancestral_domain'}">Ancestral Domain</router-link>
					<router-link class="dropdown-item" :to="{name:'actual_projecteds'}">Actual and Projected Population and Number of Households, Growth Rate by City/Municipality</router-link>
					<router-link class="dropdown-item" :to="{name:'population_densities'}">Population Density</router-link>
					<router-link class="dropdown-item" :to="{name:'projected_populations'}">Projected Population by Province</router-link>
					<router-link class="dropdown-item" :to="{name:'urban_rural_populations'}">Urban-Rural Population</router-link>

					<router-link class="dropdown-item" :to="{name:'population_by_census_year'}">Census By Year</router-link>
					<router-link class="dropdown-item" :to="{name:'household_population_by_sexes'}">House Hold Population</router-link>
					<router-link class="dropdown-item" :to="{name:'mangyan_tribes'}">Mangyan Tribe</router-link>
				</div>
			</div>
			<div class="content">
				<router-view></router-view>
			</div>
		</div>
	</div>
</template>