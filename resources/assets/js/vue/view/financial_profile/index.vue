<template>
	<div id="financial_profile">
		<div class="header">
			<div class="card rounded-0 shadow-sm">
				<div class="card-body p-3">
					<h5 class="font-weight-bold">FINANCIAL PROFILE</h5>
					<small>Note: This list all users information.</small>
				</div>
			</div>
			<div class="tabs">
				<ul class="vm-tab">
					<li><router-link :to="{name:'annual_income_budget'}">Annual Income and Budget</router-link></li>
					<li><router-link :to="{name:'income_and_expenditures'}">Income and Expenditures</router-link></li>
				</ul>
			</div>
			<div class="content">
				<router-view></router-view>
			</div>
		</div>
	</div>
</template>