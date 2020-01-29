<template>
	<div id="forest_covers">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Forest Cover</h5>
			</div>
		</div>
		<div class="container mt-1">
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

		<table class="table table-bordered table-light">
			<thead>
				<tr>
					<th>Province</th>
					<th>Closed Forest</th>
					<th>Open Forest</th>
					<th>Mangrove</th>
					<th>Total Forest</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="item in forest_covers">
					<tr>
						<td>{{item.province}}</td>
						<td class="with-input">
							<currency_input v-model="item.closed_forest"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.open_forest"></currency_input>
						</td>
						<td class="with-input">
							<currency_input v-model="item.mangrove"></currency_input>
						</td>
						<td class="text-right">
							{{
								parseFloat(item.closed_forest) +
								parseFloat(item.open_forest) +
								parseFloat(item.mangrove)
							}}
						</td>
					</tr>
				</template>
			</tbody>
			<tfoot>
				<tr>
					<th>MIMAROPA</th>
					<th class="text-right">{{total.closed_forest}}</th>
					<th class="text-right">{{total.open_forest}}</th>
					<th class="text-right">{{total.mangrove}}</th>
					<th class="text-right">
						{{
							parseFloat(total.closed_forest) +
							parseFloat(total.open_forest) +
							parseFloat(total.mangrove)
						}}
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
				forest_covers: [],
				total: {
					closed_forest: 0,
					open_forest: 0,
					mangrove: 0,
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
				axios.post('/land_and_natural_resources/forest_covers/get', {year: year})
						.then(data => {
							vm.forest_covers = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/land_and_natural_resources/forest_covers/update', {data: vm.forest_covers})
						.then(data => {
							vm.$toastr('success', 'Information is now update!', 'Forest Cover')
						})
			}
		},
		watch: {
			year: function(val){
				if(val == "" || val == null)
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			},
			forest_covers: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total = {
								closed_forest: 0,
								open_forest: 0,
								mangrove: 0,
							};

					for (var i = 0; i < val.length; i++) {
						vm.total.closed_forest += parseFloat(val[i].closed_forest);
						vm.total.open_forest += parseFloat(val[i].open_forest);
						vm.total.mangrove += parseFloat(val[i].mangrove);
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