<template>
	<div id="ancestral_domain">
		 	<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">List of Ancestral Domain Applications and their status</h5>
				</div>
			</div>

			<div class="row mt-1">
				<div class="col-md">
					<table class="table table-light table-bordered">
						<thead>
							<tr>
								<th>Name and Location of Ancestral Domain</th>
								<th>Ethnolunguistic Tribal Group</th>
								<th>Estimated Area (Hectares) of Ancestral Domain</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="item in ancestral_domain">
								<td>{{item.name_address}}</td>
								<td>{{item.ethnolinguistic}}</td>
								<td>{{item.estimated_area}}</td>
							</tr>
							<tr v-if="ancestral_domain.length <= 0">
								<td colspan="4">No item</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
	</div>
</template>
<script>
	export default {
		props: ["year"],
		data: function(){
			return  {
				ancestral_domain: [],
				updateStatus: false,
			}
		},
		methods:{
			getInfo:function(year)
			{
				var vm = this;
				axios.post('/demograph/ancestral_domain/get',{year: year})
						.then(data => {
							vm.ancestral_domain = data.data
						})
			},

		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch: {
			'year' : function(val){
				if(val == "")
				{
					this.getInfo()
				}else{
					this.getInfo(val);
				}
			}
		},
		mounted: function(){
			this.getInfo();
		}
	}
</script>