<template>
	<div id="list_of_ratio_stations_and_cable_tv_networks">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">List of radio stations and cable tv networks</h5>
			</div>
		</div>

		<div class="row mt-1">
			<div class="col-md">
				<div class="card">
					<div class="card-body">
						<p class="font-weight-bold">Satellite television networks</p>
						<div class="form-group">
							<input type="text" class="form-control" v-model="form_satellite_television_networks.name">
						</div>
						<div class="form-group">
							<v-select  v-model="form_satellite_television_networks.year" :options="defaultYear"></v-select>
							<!-- <select class="form-control" v-model="form_satellite_television_networks.year">
								<option value="" disabled selected>-- Select Year --</option>
								<option v-for="item in defaultYear" :value="item">{{item}}</option>
							</select> -->
						</div>
						<div class="row justify-content-end">
							<div class="col-auto">
								<button class="btn btn-primary" @click="create_satellite_television_networks" v-if="!bool_satellite_television_networks">Create</button>
								<button class="btn btn-info" @click="update_satellite_television_networks" v-if="bool_satellite_television_networks">Update</button>
							</div>
						</div>
					</div>
					<ul class="list-group list-group-flush">
						<template v-for="item in satellite_television_networks">
							<li class="list-group-item">
								<div class="row justify-content-between">
									<div class="col-auto">
										{{item.name}}
									</div>
									<div class="col-auto">
										<button class="btn btn-danger btn-sm" @click="delete_satellite_television_networks(item)">x</button>
										<button class="btn btn-info btn-sm" @click="toggle_satellite_television_networks(item)">/</button>
									</div>
								</div>
							</li>
						</template>
					</ul>
				</div>
			</div>
			<div class="col-md">
				<div class="card">
					<div class="card-body">
						<p class="font-weight-bold">Radio stations</p>
						<div class="form-group">
							<input type="text" class="form-control" v-model="form_radio_stations.name">
						</div>

						<div class="form-group">
								<v-select  v-model="form_radio_stations.year" :options="defaultYear"></v-select>
							<!-- <select class="form-control" v-model="form_radio_stations.year">
								<option value="" disabled selected>-- Select Year --</option>
								<option v-for="item in defaultYear" :value="item">{{item}}</option>
							</select> -->
						</div>
						<div class="row justify-content-end">
							<div class="col-auto">
								<button class="btn btn-primary" @click="create_radio_stations" v-if="!bool_radio_stations">Create</button>
								<button class="btn btn-info" @click="update_radio_stations" v-if="bool_radio_stations">Update</button>
							</div>
						</div>

					</div>
					<ul class="list-group list-group-flush">
						<template v-for="item in radio_stations">
							<li class="list-group-item">
								<div class="row justify-content-between">
									<div class="col-auto">
										{{item.name}}
									</div>
									<div class="col-auto">
										<button class="btn btn-danger btn-sm" @click="delete_radio_stations(item)">x</button>
										<button class="btn btn-info btn-sm" @click="toggle_radio_stations(item)">/</button>
									</div>
								</div>
							</li>
						</template>
					</ul>
				</div>
			</div>
			<div class="col-md">
				<div class="card">
					<div class="card-body">
						<p class="font-weight-bold">Cable television networks</p>
						<div class="form-group">
							<input type="text" class="form-control" v-model="form_cable_television_networks.name">
						</div>
						<div class="form-group">

							<v-select  v-model="form_cable_television_networks.year" :options="defaultYear"></v-select>
							<!-- <select class="form-control" v-model="form_cable_television_networks.year">
								<option value="" disabled selected>-- Select Year --</option>
								<option v-for="item in defaultYear" :value="item">{{item}}</option>
							</select> -->
						</div>
						<div class="row justify-content-end">
							<div class="col-auto">
								<button class="btn btn-primary" @click="create_cable_television_networks" v-if="!bool_cable_television_networks">Create</button>
								<button class="btn btn-info" @click="update_cable_television_networks" v-if="bool_cable_television_networks">Update</button>
							</div>
						</div>

					</div>
					<ul class="list-group list-group-flush">
						<template v-for="item in cable_television_networks">
							<li class="list-group-item">
								<div class="row justify-content-between">
									<div class="col-auto">
										{{item.name}}
									</div>
									<div class="col-auto">
										<button class="btn btn-danger btn-sm" @click="delete_cable_television_networks(item)">x</button>
										<button class="btn btn-info btn-sm" @click="toggle_cable_television_networks(item)">/</button>
									</div>
								</div>
							</li>
						</template>
					</ul>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data: function(){
			return {
				satellite_television_networks: [],
				radio_stations: [],
				cable_television_networks: [],
				form_satellite_television_networks: {
					name: "",
					year: new Date().getFullYear(),
				},
				form_radio_stations: {
					name: "",
					year: new Date().getFullYear(),
				},
				form_cable_television_networks: {
					name: "",
					year: new Date().getFullYear(),
				},
				bool_satellite_television_networks: false,
				bool_radio_stations: false,
				bool_cable_television_networks: false,
			}
		},
		methods: {
			get_satellite_television_networks: function(){
				var vm = this;
				axios.post('/infrustructure_and_utilities/satellite_television_networks/get')
					.then(data => {
						vm.satellite_television_networks = data.data;
						vm.bool_satellite_television_networks = false;
						vm.form_satellite_television_networks = {
							name: "",
							year: "",
						}
					})
			},
			get_radio_stations: function(){
				var vm = this;
				axios.post('/infrustructure_and_utilities/radio_stations/get')
					.then(data => {
						vm.radio_stations = data.data;
						vm.bool_radio_stations = false;
						vm.form_radio_stations = {
							name: "",
							year: "",
						}
					})
			},
			get_cable_television_networks: function(){
				var vm = this;
				axios.post('/infrustructure_and_utilities/cable_television_networks/get')
					.then(data => {
						vm.cable_television_networks = data.data;
						vm.bool_cable_television_networks = false;
						vm.form_cable_television_networks = {
							name: "",
							year: "",
						}
					})
			},
			update_satellite_television_networks: function(){
				var vm = this;
				axios.post('/infrustructure_and_utilities/satellite_television_networks/update', vm.form_satellite_television_networks)
						.then(data => {
							vm.get_satellite_television_networks();
						})
			},
			update_radio_stations: function(){
				var vm = this;
				axios.post('/infrustructure_and_utilities/radio_stations/update', vm.form_radio_stations)
						.then(data => {
							vm.get_radio_stations();
						})
			},
			update_cable_television_networks: function(){
				var vm = this;
				axios.post('/infrustructure_and_utilities/cable_television_networks/update', vm.form_cable_television_networks)
						.then(data => {
							vm.get_cable_television_networks();
						})
			},
			create_satellite_television_networks: function(){
				var vm = this;
				axios.post('/infrustructure_and_utilities/satellite_television_networks/create', vm.form_satellite_television_networks)
					.then(data => {
						vm.get_satellite_television_networks();
					})
			},
			create_radio_stations: function(){
				var vm = this;
				axios.post('/infrustructure_and_utilities/radio_stations/create', vm.form_radio_stations)
					.then(data => {
						vm.get_radio_stations();
					})
			},
			create_cable_television_networks: function(){
				var vm = this;
				axios.post('/infrustructure_and_utilities/cable_television_networks/create', vm.form_cable_television_networks)
					.then(data => {
						vm.get_cable_television_networks();
					})
			},
			delete_satellite_television_networks: function(info){
				var vm = this;
				axios.post('/infrustructure_and_utilities/satellite_television_networks/delete', info)
						.then(data => {
							vm.get_satellite_television_networks();
						})
			},
			delete_radio_stations: function(info){
				var vm = this;
				axios.post('/infrustructure_and_utilities/radio_stations/delete', info)
						.then(data => {
							vm.get_radio_stations();
						})
			},
			delete_cable_television_networks: function(info){
				var vm = this;
				axios.post('/infrustructure_and_utilities/cable_television_networks/delete', info)
						.then(data => {
							vm.get_cable_television_networks();
						})
			},
			toggle_satellite_television_networks: function(val)
			{
				var vm = this;
				vm.bool_satellite_television_networks = true;
				vm.form_satellite_television_networks = val;
			},
			toggle_radio_stations: function(val)
			{
				var vm = this;
				vm.bool_radio_stations = true;
				vm.form_radio_stations = val;
			},
			toggle_cable_television_networks: function(val)
			{
				var vm = this;
				vm.bool_cable_television_networks = true;
				vm.form_cable_television_networks = val;
			},
		},
		mounted: function(){
			this.get_satellite_television_networks();
			this.get_radio_stations();
			this.get_cable_television_networks();
		},
		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			},
		},
	}
</script>