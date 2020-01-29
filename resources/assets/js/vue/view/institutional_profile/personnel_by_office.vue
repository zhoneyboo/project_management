<template>
	<div id="personnel_by_office">
		<div class="container">

			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">PROVINCIAL GOVERNMENT PERSONNEL BY OFFICE</h5>
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

			<table class="table table-light table-bordered mt-1">
				<thead>
					<tr>
						<th></th>
						<th>Name of Office</th>
						<th>No. of Plantilla Positions</th>
						<th>No. of Filled-up Positions</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="(data, index) in personnel_by_office">
						<template v-for="(item, no) in data">
							<tr>
								<td><span v-if="no == 0">{{index}}. </span></td>
								<td>{{item.name_of_office}}</td>
								<td class="with-input">
									<currency_input v-model="item.no_plantilla_position"></currency_input>
								</td>
								<td class="with-input">
									<currency_input v-model="item.no_of_filled_up_position"></currency_input>
								</td>
							</tr>
						</template>
					</template>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="2">Total</th>
						<th>{{total_plantilla}}</th>
						<th>{{total_filled_up}}</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</template>
<script>
	export default{
		data: function(){
			return {
				personnel_by_office: [],
				total_plantilla:0,
				total_filled_up:0,
				year: new Date().getFullYear(),
			}
		},
		computed:{
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch:{

			personnel_by_office: {
				handler: function(val, oldVal)
				{
					var vm = this;
					vm.total_plantilla = 0;
					vm.total_filled_up = 0;

					for(var item in val)
					{
						for(var con in val[item])
						{
							vm.total_plantilla += parseFloat(val[item][con].no_plantilla_position);
							vm.total_filled_up += parseFloat(val[item][con].no_of_filled_up_position);
						}
					}
				},
				deep: true
			},
			year: function(val)
			{
				if(val == "")
				{
					this.getData();
				}else{
					this.getDataYear(val);
				}
			},
		},
		mounted:function(){
			this.getData();
		},
		methods:{
			getData:function(){
				var vm = this;
				axios.post('/personnel/office/get')
					.then(data => {
						vm.personnel_by_office = data.data;
					})
			},

			getDataYear:function(year){
				var vm = this;
				axios.post('/personnel/office/get', {year:year})
					.then(data => {
						vm.personnel_by_office = data.data;
					})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/personnel/office/update', {data: vm.personnel_by_office})
						.then(data => {
							vm.$toastr('success', 'Information is now updated!', 'PROVINCIAL GOVERNMENT PERSONNEL BY OFFICE')
						})
			}
		}

	}
</script>