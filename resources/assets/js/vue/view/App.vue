<template>
	<div id="main">
		<navbar></navbar>
		<div class="wrapper">
			<article id="article">
				<router-view></router-view>
			</article>	
		</div>
	</div>
</template>
<script>
	export default{
		methods: {
			getData:function(){
				var vm = this;
				axios.post('/auth/info')
					.then(data => {
						vm.$store.commit('SET_USER_INFORMATION', data.data)
					})
					.catch(error => {
						window.location.replace("/login");
					})
			},
		},
		mounted:function(){
			this.$store.commit('GET_YEAR')
			this.getData();
		}
	}
</script>