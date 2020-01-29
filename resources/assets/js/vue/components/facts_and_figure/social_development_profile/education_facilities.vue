<template>
	<div id="education_facilities">
		
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Education Facilities</h4>
			</div>
		</div>
	 	<table class="table table-light table-bordered">
			<tr>
				<th>Facilities</th>
				<th>Province</th>
				<th>Calapan City</th>
			</tr>
			<template v-for="item in education_facilities">
				<tr>
					<td>{{item.facilities}}</td>
					<td class="text-right">{{item.province}}</td>
					<td class="text-right">{{item.calapan}}</td>
				</tr>
			</template>
		</table>
	</div>
</template>
<script>
	export default{
		props: ["year"],
		data: function(){
			return {
				education_facilities: [],
				form: {
					facilities: '',
					year: '',
				}
			}
		},
		methods:{
			getInfo: function(year){
				var vm = this;
				if(year == "")
				{
					axios.post('/social_development/education_facilities/get')
						.then(data => {
							vm.education_facilities = data.data;
						})
					}else{
						axios.post('/social_development/education_facilities/get', {year: year})
						.then(data => {
							vm.education_facilities = data.data;
						})
					}
			},
		},
		mounted: function(){
			this.getInfo();
		},
		watch: {
			year: function(val){
				if(val == "")
				{
					this.getInfo();
				}else{
					this.getInfo(val)
				}
			}
		},
	}
</script>