<template>
	<div id="user_access_list">
		<div class="container">
			<div class="row">
				<div class="col-md">
					<div class="card rounded-0 shadow-sm">
						<div class="card-body p-3">
							<h5 class="font-weight-bold">MANAGE USER'S ACCESS</h5>
							<small>Note: This list show all type of access on your site.</small>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-between mt-1">
				<div class="col-md-5">
					<div class="card rounded-0">
						<div class="card-body">
							<p class="font-weight-bold">ADD NEW USER'S ACCESS</p>
							<hr>
							<form @submit.prevent="submit">
								<div class="form-group">
									<label for="">Access Key</label>
									<input type="text" class="form-control form-control-sm" v-model="form.access_key">
								</div>
								<div class="form-group">
									<label for="">Access Name</label>
									<input type="text" class="form-control form-control-sm" v-model="form.access_name">
								</div>
								<div class="form-group">
									<label for="">Description</label>
									<input type="text" class="form-control form-control-sm" v-model="form.description">
								</div>
								<button class="btn btn-primary btn-sm" type="submit">Add</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="card rounded-0">
						<div class="card-body">
							<p class="font-weight-bold m-0">LIST OF USER'S ACCESS</p>
						</div>
					</div>
					<ul class="list-group mt-1">
					  <li class="list-group-item" v-for="access in access_arr">
					  	<h5><b>Name: </b>{{access.access_name}} ({{access.access_key}} )</h5>
					  	<small><b>Description: </b>	{{access.description}}</small><br>

					  	<div class="row justify-content-end">
					  		<div class="col-auto">
					  			<div class="btn-group ml-auto">
							  		<button class="btn btn-sm btn-primary">Edit</button>
							  		<button class="btn btn-sm btn-danger" @click="deleteAccess(access.id)">Remove</button>
							  	</div>
					  		</div>
					  	</div>
					  </li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data:function(){
			return {
				form: {
					access_key: '',
					access_name: '',
					description: '',
				},
				access_arr: []
			}
		},
		methods:{
			submit:function(){
				var vm = this;
				axios.post('/user/privilege/new', vm.form)
						.then(data =>{
							alert(data.data);
							vm.getAll();
							vm.clearForm();
						})
						.catch(error => {
							alert(error.response.data.message)
						})

			},
			getAll:function(){
				var vm = this;
				axios.post('/user/privilege/get')
						.then(data => {
							vm.access_arr = data.data;
						})
			},
			deleteAccess: function(id)
			{
				var vm = this;
				axios.post('/user/privilege/delete', {id: id})
						.then(data => {
							alert(data.data)
							vm.getAll();
						})
						.catch(error => {
							alert(error.response.data.message)
						})
			},
			clearForm: function(){
				this.form = {
								access_key: '',
								access_name: '',
								description: '',
							}
			}
		},
		mounted:function(){
			this.getAll();
		}
	}
</script>