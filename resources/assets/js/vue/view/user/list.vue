<template>
	<div id="user_list" class="container">
		<div class="row">
			<div class="col-md">
				<div class="card rounded-0 shadow-sm">
					<div class="card-body p-3">
						<h5 class="font-weight-bold">MANAGE USER'S</h5>
						<small>Note: This list all users information.</small>
					</div>
				</div>
			</div>
		</div>

		<v-datatable 
			class="mt-1"
			:data="list" 
			:fields="fields"
			tclass="table-sm table-striped table-light"
			:otherFields="otherField"
			>
			<thead slot="thead" class="text-center text-uppercase">
				<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>Email</th>
					<th>Date Added</th>
					<th>Last Updated</th>
					<!-- <th></th> -->
				</tr>
			</thead>
			<!-- <template slot="action" slot-scope="props" href="#">
				<div class="btn-group">
					<button type="button" 
							class="btn btn-link"
							@click="setPrivilege(props.row.id)" >
					  Set site privilege
					</button>
				</div>
			</template> -->
		</v-datatable>
		<modal title="USER ACCESS" 
				id="setPrivilegeModal" 
				positive_button="Save and exit">
			<div slot="modal-body">
				<div class="form-group">
					<label class="font-weight-bold">List of Privilege</label>
					<div class="row">
						<div class="col pr-1">
							<select class="form-control" v-model="form.access_id">
								<option value="" disabled>Select Privilege</option>
								<option v-for="privilege in availablePrivilege" :value="privilege.id">{{privilege.access_name}}</option>
							</select>
						</div>
						<div class="col-auto d-flex align-items-center pl-0">
							<button class="btn btn-primary" @click="submit">Add</button>
						</div>
					</div>
				</div>
				<hr>

				<p class="font-weight-bold mb-1">USER PRIVILEGE</p>
				<ul>
					<li class="text-danger" 
						v-if="userPrivilege.length <= 0">
						No user privilege available</li>
					<li v-for="privilege in userPrivilege">{{privilege.access.access_name}} <button class="btn btn-link text-danger" @click="removePrivilege(privilege.user_id, privilege.access_id)">x</button></li>
				</ul>
			</div>
		</modal>



	</div>
</template>
<script>
	export default{
		data:function(){
			return {
				list: [],
				userPrivilege:[],
				availablePrivilege:[],
				form: {
					user_id: '',
					access_id: '',
				},

				fields: [	
							'id',
							'name',
							'email',
							'created_at',
							'updated_at',
						],
				otherField:[],
			}
		},
		methods: {
			getData:function()
			{
				var vm = this;
				axios.post('/user/list')
						.then(data => {
							vm.list = data.data;
						})

				axios.post('/user/privilege/get')
						.then(data => {
							vm.availablePrivilege = data.data;
						})
			},
			submit:function()
			{
				var vm = this;
				axios.post('/user/access/add', vm.form)
						.then(data => {
							alert('New data is saved')
							vm.setPrivilege(vm.form.user_id)
						})
						.catch(error => {
							alert('Same privilege found')
						})
			},
			removePrivilege:function(user_id, access_id){
				var form = {
					user_id:user_id,
					access_id: access_id
				}
				var vm = this;
				axios.post('/user/access/remove', form)
						.then(data => {
							vm.setPrivilege(form.user_id)
						})
			},
			setPrivilege:function(id)
			{
				var vm = this;
				vm.form.user_id = id;

				axios.post('/user/access/get', {id: id})
						.then(data => {
							vm.userPrivilege = data.data;
						})
						.catch(error => {

						})
				$('#setPrivilegeModal').modal("show");
			}

		},
		mounted:function(){
			this.getData();
		}
	}
</script>
