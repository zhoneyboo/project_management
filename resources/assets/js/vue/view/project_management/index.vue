<template>
	<div id="project_management">
		<div class="header">
			<div class="card rounded-0 shadow-sm">
				<div class="card-body p-3">
						<h5 class="font-weight-bold text-uppercase">Project Monitoring</h5>
						<small>Note: This list all Provincial Governement of Oriental Mindoro General Information.</small>
				</div>
			</div>
			<div class="tabs">
				<ul class="vm-tab rounded-bottom">
					<li>
						<router-link :to="{name:'project_management'}">List of Project</router-link>
					</li>

					<li>
						<router-link :to="{name:'project_management_encoding'}">Add New Project</router-link>
					</li>

					<li>
						<router-link :to="{name:'project_management_print'}">Report</router-link>
					</li>

					
				</ul>
			</div>
			<div class="content mt-1">
				<router-view></router-view>
			</div>
		</div>
	</div>
</template>
<script>
	export default{

	}
</script>