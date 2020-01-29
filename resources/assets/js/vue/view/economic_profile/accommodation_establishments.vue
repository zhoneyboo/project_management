<template>
	<div id="accommodation_establishments">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Oriental Mindoro Accomodation Establishments</h5>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-4 col-md-3 col-lg-2 col-xl-2 ml-auto pr-1">
					<div class="form-group p-0 m-0">
						<span>Year: </span> 
						<v-select  v-model="year" :options="defaultYear"></v-select>
						<!-- <select class="form-control" v-model="year">
							<option value="" disabled selected>-- Select Year --</option>
							<option v-for="item in defaultYear" :value="item">{{item}}</option>
						</select> -->
					</div>
				</div>
				<div class="col-auto d-flex align-items-end p-0">
					<button class="btn btn-primary" @click="updateInfo">Update</button>
				</div>
			</div>
		</div>
		<table class="table table-bordered table-light mt-1">
			<thead>
				<tr>
					<th>City/Municipality</th>
					<th>No. of <br>Accommodation<br> Establishments</th>
					<th>No. of Rooms</th>
					<th>Bedding Capacity</th>
					<th>Total Employment</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="item in accommodation_establishments">
					<tr v-if="item.municipality == 1" class="bg-secondary text-white">
						<td colspan="5">1st District</td>
					</tr>
					<tr v-if="item.municipality == 9" class="bg-secondary text-white">
						<td colspan="5">2nd District</td>
					</tr>
					<tr>
						<td>{{item.municipality_name}}</td>
						<td class="with-input">
							<currency_input v-model="item.no_of_accommodation_establishment"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.no_of_room"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.bedding_capacity"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.total_employment"></currency_input>
						</td>
					</tr>
				</template>
			</tbody>
			<tfoot>
				<tr>
					<th>ORIENTAL MINDORO</th>
					<th class="text-right">
						<currency_label :data="total.no_of_accommodation_establishment"></currency_label>
					</th>
					<th class="text-right">
						<currency_label :data="total.no_of_room"></currency_label>
					</th>
					<th class="text-right">
						<currency_label :data="total.bedding_capacity"></currency_label>
					</th>
					<th class="text-right">
						<currency_label :data="total.total_employment"></currency_label>
					</th>
				</tr>
			</tfoot>
		</table>
	</div>
</template>

<script>
	export default{
		data: function(){
			return {
				year: new Date().getFullYear(),
				accommodation_establishments: [],
				total: {
					no_of_accommodation_establishment: 0,
					no_of_room: 0,
					bedding_capacity: 0,
					total_employment: 0,
				}
			}
		},
		mounted:function(){
			this.getInfo();
		},
		methods: {
			getInfo: function(year)
			{
				var vm = this;
				axios.post('/economic_profile/accommodation_establishments/get', {year: year})
						.then(data => {
							vm.accommodation_establishments = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/economic_profile/accommodation_establishments/update', {data: vm.accommodation_establishments})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'Oriental Mindoro Accomodation Establishment')
						})
			}
		},
		watch: {
			year: function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			},
			accommodation_establishments: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total.no_of_accommodation_establishment = 0;
					vm.total.no_of_room = 0;
					vm.total.bedding_capacity = 0;
					vm.total.total_employment = 0;

					for (var i = 0; i < val.length; i++) {
						vm.total.no_of_accommodation_establishment += parseFloat(val[i].no_of_accommodation_establishment);
						vm.total.no_of_room += parseFloat(val[i].no_of_room);
						vm.total.bedding_capacity += parseFloat(val[i].bedding_capacity);
						vm.total.total_employment += parseFloat(val[i].total_employment);
					}
				},
				deep: true
			}
		},

		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},

	}
</script>