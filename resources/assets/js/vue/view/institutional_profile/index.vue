<template>
	<div id="Institutional_profile">
			<div class="header">
			<div class="card rounded-0 shadow-sm">
				<div class="card-body p-3">
					<h5 class="font-weight-bold text-uppercase">Institutional Profile</h5>
					<small>Note: This list all Provincial Governement of Oriental Mindoro General Information.</small>
				</div>
			</div>
			<div class="tabs">
				<ul class="vm-tab">
					<li><router-link :to="{name:'personnel_by_office'}">Personnel by office</router-link></li>
					<li><router-link :to="{name:'personnel_by_status'}">Personnel by Status</router-link></li>
				</ul>
			</div>
			<div class="content">
				<router-view></router-view>
			</div>
		</div>
	</div>
</template>