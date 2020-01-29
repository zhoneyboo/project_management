<template>
	<div class="user_management">
		<div class="header">
			<div class="card rounded-0 shadow-sm">
				<div class="card-body p-3">
					<h5 class="font-weight-bold">USER MANAGEMENT SETTING</h5>
					<small>Note: This list all users information.</small>
				</div>
			</div>
			<div class="tabs">
				<ul class="vm-tab">
					<li><router-link :to="{name:'user_list'}">User List </router-link></li>
					<!-- <li><router-link :to="{name:'user_create'}">User Logs </router-link></li> -->
					<li><router-link :to="{name:'user_create'}">User Registration</router-link></li>
					<!-- <li><router-link :to="{name:'user_access_list'}">User's Access List</router-link></li> -->
				</ul>
			</div>
			<div class="content">
				<router-view></router-view>
			</div>
		</div>
	</div>
</template>