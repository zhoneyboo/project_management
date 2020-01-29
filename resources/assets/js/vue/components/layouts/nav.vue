<template>
	<nav class="navbar navbar-expand-lg navbar-dark bg-pepsi p-0 sticky-top">
		<div class="container">
	  		<a class="navbar-brand" href="/">OrMin Profile</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		  		<ul class="navbar-nav">
		  			<li class="nav-item" v-if="info.role == 3 || info.role == 1"><router-link class="nav-link" to="/project_management">Project Monitoring</router-link></li>
		  			<li class="nav-item" v-if="info.role == 2  || info.role == 1"><router-link class="nav-link" to="/facts_and_figure">Facts and Figure</router-link></li>
		  		</ul>
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item dropdown">
			      	
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          {{info.name}} <font-awesome-icon :icon="['fas', 'caret-down']" />
			        </a>
			        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"><!-- 
			          <a class="dropdown-item" href="#">Action</a> -->
			        	<router-link class="dropdown-item" :to="{name: 'change_password'}">Change Password</router-link>
			          <template  v-if="info.role == 1">
			        	<router-link class="dropdown-item" to="/user_management">User Management</router-link>
			          </template>
			          	<div class="dropdown-divider"></div>
			          <button class="dropdown-item" type="button" @click="logout">Sign out</button>
			        </div>
			      </li>
			    </ul>
		  </div>
		</div>
	</nav>
</template>
<script>
	export default{
		computed: {
			info: function(){
				return this.$store.state.USER_INFO;
			},
		},


		methods: {
			logout: function()
			{
				axios.post('/logout')
						.then(data => {
							window.location.replace("/login");
						})
						.catch(error => {
							window.location.replace("/login");
						})
			},
			toggleClass: function(){
				$('#content').toggleClass('toggle');
			}
		}
	}
</script>