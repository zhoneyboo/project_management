<template>
	<div id="doh_licensed_health_facilities" >
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">DOH-Licensed Health Facilities</h4>
			</div>
		</div>
	 	<table class="table table-light table-bordered">
			<thead class="text-center">
				<tr>
					<th></th>
					<th>Name of Facility</th>
					<th>Address</th>
					<th>Classification</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="(data, index) in doh_licensed_health_facilities">
					<tr>
						<td class="text-center">{{index + 1}}</td>
						<td>{{data.name_of_facility}}</td>
						<td>{{data.address}}</td>
						<td class="text-center">{{data.classification}}</td>		
					</tr>
				</template>
				<template v-if="doh_licensed_health_facilities.length <= 0">
					<tr>
						<td colspan="4">
							No item found
						</td>
					</tr>
				</template>
			</tbody>
		</table>
	</div>
</template>
<script>
	export default{
		data: function(){
			return {
				doh_licensed_health_facilities: [],
				form: {
					name_of_facility: '',
					address: '',
					classification: '',
				},
				editStatus : false
			}
		},
		methods:{
			addInfo: function(){
				var vm = this;
				if(vm.editStatus)
				{
					axios.post('/social_development/doh_licensed_health_facilities/update', vm.form)
						.then(data => {
							vm.getInfo();
							vm.editStatus = false;
						})
				}else{
					axios.post('/social_development/doh_licensed_health_facilities/create', vm.form)
						.then(data => {
							vm.getInfo();
						})
				}
			},
			getInfo: function(){
				var vm = this;
				axios.post('/social_development/doh_licensed_health_facilities/get')
						.then(data => {
							vm.doh_licensed_health_facilities = data.data;
						})
			},
			editInfo: function(data){
				var vm = this;
				vm.form = data;
				vm.editStatus = true;
			},
			deleteInfo: function(id){
				var vm = this;
				axios.post('/social_development/doh_licensed_health_facilities/delete', {id: id})
					.then(data => {
						vm.getInfo();
					})
			}
		},
		mounted: function(){
			this.getInfo();
		},
		computed: {
			
		}
	}
</script>