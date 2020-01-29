<template>
	<div id="change_password" class="mt-5">
		<div class="container-fluid">
			<div class="row justify-content-center align-items-center vh-100">
				<div class="col-md-5">
					<div class="card">
						<div class="card-header">
							<h5>Change Password</h5>
						</div>
						<div class="card-body">
							<form @submit.prevent="submit">
								<div class="form-group">
									<label for="old_password">Current Password</label>
									<input type="password" class="form-control" v-model="form_data.old_password">
									<small class="text-danger" v-if="validate.old_password">{{validate.old_password[0]}}</small>
								</div>
								<div class="form-group">
									<label for="old_password">New Password</label>
									<input type="password" class="form-control" v-model="form_data.password">
									<small class="text-danger" v-if="validate.password">{{validate.password[0]}}</small>
								</div>
								<div class="form-group">
									<label for="old_password">Repeat Password</label>
									<input type="password" class="form-control" v-model="form_data.password_confirmation">
									<small class="text-danger" v-if="validate.password_confirmation">{{validate.password_confirmation[0]}}</small>
								</div>
								<div class="row justify-content-end">
									<div class="col-md-auto">
										<button class="btn btn-success" type="submit">Submit</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

	export default {
		mounted:function(){
			// this.$store.commit('checkAuth');
		},
		data:function(){
			return {
				form_data : {
					password: '',
					old_password: '',
					password_confirmation: '',
				},
				validate: [],
			}
		},
		methods:{
			submit:function(){
				var vm = this;
				axios.post('/user/change_password', vm.form_data)
						.then(data => {

							if(data.data.type == "error")
							{
								alert(data.data.message);
							}else{
								alert(data.data.message);
								vm.$router.push({path: ''});
							}
							// vm.$toastr(data.data.type, data.data.message, 'USER');
						})
						.catch(error => {
								vm.validate = error.response.data.errors;
						});
			}
		}
	}
</script>