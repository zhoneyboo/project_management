<template>
	<div id="facts_and_figure">
		<div class="header">
			<div class="card rounded-0 shadow-sm">
				<div class="card-body p-3">
					<div class="container">
						<h5 class="font-weight-bold text-uppercase ">Facts and Figure</h5>
						<small>Note: This list all Provincial Governement of Oriental Mindoro General Information.</small>
					</div>
				</div>
			</div>
			<nav class="navbar navbar-expand-lg navbar-dark bg-greeny p-0">
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBarFactAndFigure" aria-controls="navBarFactAndFigure" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navBarFactAndFigure">
			    <ul class="navbar-nav mr-auto">
			    	<li class="nav-item"><router-link class="nav-link" :to="{name: 'general_information_encoding'}">General Information</router-link></li>
					<li class="nav-item"><router-link class="nav-link" to="/facts_and_figure/land_and_other_natural_resources">Land and Other Natural Resources</router-link></li>
					<li class="nav-item"><router-link class="nav-link" to="/facts_and_figure/demograph">Demograph</router-link></li>
					<li class="nav-item"><router-link class="nav-link" to="/facts_and_figure/economic_profile">Economic Profile</router-link></li>
					<li class="nav-item"><router-link class="nav-link" to="/facts_and_figure/utilities_and_infrustructure">Infrastructure and Utilities</router-link></li>
					<li class="nav-item"><router-link class="nav-link" to="/facts_and_figure/financial_profile">Financial Profile</router-link></li>
					<li class="nav-item"><router-link class="nav-link" to="/facts_and_figure/social_development_profile">Social Development Profile</router-link></li>
					<li class="nav-item"><router-link class="nav-link" to="/facts_and_figure/institutional_profile">Institutional Profile</router-link></li>
					<li class="nav-item"><router-link class="nav-link" to="/">Print</router-link></li>
			    </ul>
			  </div>
			</nav>
		</div>
		<div class="content container">
			<router-view></router-view>
		</div>
	</div>
</template>
<script>
	export default{

	}
</script>