<template>
	<div id="personnel_by_office">
			<div class="card bg-info">
				<div class="card-body pl-3 pr-3 pt-2 pb-2">
					<h4 class="font-weight-bold text-uppercase text-white">PROVINCIAL GOVERNMENT PERSONNEL BY OFFICE</h4>
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
								<td class="text-right font-weight-bold">{{item.no_plantilla_position}}</td>
								<td class="text-right font-weight-bold">{{item.no_of_filled_up_position}}</td>
							</tr>
						</template>
					</template>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="2">Total</th>
						<th class="text-right font-weight-bold">{{total_plantilla}}</th>
						<th class="text-right font-weight-bold">{{total_filled_up}}</th>
					</tr>
				</tfoot>
			</table>
	</div>
</template>
<script>
	export default{
		data: function(){
			return {
				personnel_by_office: [],
				total_plantilla:0,
				total_filled_up:0,
				year: '',
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

						})
			}
		}

	}
</script>