<template>
	<div id="crime_statistics_and_protective_facilities" >
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Crime Statistics and Protective Facilities</h4>
			</div>
		</div>
		<table class="table table-light table-bordered">
			<template v-for="(data, index) in crime_statistics_and_protective_facilities">
				<tr>
					<th colspan="2">{{index}}</th>
				</tr>
				<template v-for="item in data">
					<tr>
						<td width="50%">{{item.crime}}</td>
						<td>{{item.number}}</td>
					</tr>
				</template>
			</template>
		</table>
	</div>
</template>


<script>
	export default{
		data: function(){
			return {
				year: '',
				crime_statistics_and_protective_facilities: [],
			}
		},
		methods:{
			getInfo: function(year){
				var vm = this;
				axios.post('/social_development/crime_statistics_and_protective_facilities/get', {year: year})
					.then(data => {
						vm.crime_statistics_and_protective_facilities = data.data;
					})
			}
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
		}
	}
</script>