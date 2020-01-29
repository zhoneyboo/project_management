<template>
	<div id="new">
		<div class="container">
			<div class="row">
				<div class="col-md">
					<div class="card rounded-0 shadow-sm">
						<div class="card-body p-3">
							<h5 class="font-weight-bold">NEW USER'S REGISTRATION</h5>
							<small>Note: Create new user's for application access.</small>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center mt-1">
				<div class="col-md">
					<div class="card">
						<div class="card-body">
							<form @submit.prevent="submitCreate">
								<div class="form-group">
									<label for="">User's Full Name</label>
									<input type="text" class="form-control" v-model="form.name">
									<small class="text-danger" v-if="validate.name">{{validate.name[0]}}</small>
								</div>

								<div class="form-group">
									<label for="">Username</label>
									<input type="text" class="form-control" v-model="form.username">
									<small class="text-danger" v-if="validate.username">{{validate.username[0]}}</small>
								</div>
								<div class="form-group">
									<label for="">Password</label>
									<input type="password" class="form-control" v-model="form.password">
									<small class="text-danger" v-if="validate.password">{{validate.password[0]}}</small>
								</div>

								<div class="form-group">
									<label for="">Repeat Password</label>
									<input type="password" class="form-control" v-model="form.password_confirmation">
									<small class="text-danger" v-if="validate.password_confirmation">{{validate.password_confirmation[0]}}</small>
								</div>
								<button class="btn btn-primary" type="submit"> Add user</button>
							</form>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data:function(){
			return{
				form: {
					password : '',
					username : '',
					name : '',
					password_confirmation : '',
				},
				validate:[]
			}
		},
		methods:{
			submitCreate:function(){
				var vm = this;
				axios.post('/user/create', vm.form)
						.then(data => {
							alert('New user is now added');
							vm.form = {
								password : '',
								username : '',
								name : '',
								password_confirmation : '',
							};
							vm.validate = [];
						}).catch(error => {
							vm.validate = error.response.data.errors;
							alert(error.response.data.message);
						});
			}
		}
	}
</script>