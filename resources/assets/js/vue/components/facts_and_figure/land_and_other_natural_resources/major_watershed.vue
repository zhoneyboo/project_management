<template>
	<div id="major_watershed">
		<div class="card bg-info">
			<div class="card-body pl-3 pr-3 pt-2 pb-2">
				<h4 class="font-weight-bold text-uppercase text-white">Major Watershed</h4>
			</div>
		</div>
		<table class="table table-light table-bordered mt-1">
			<thead>
				<tr>
					<th>Name of Watershed</th>
					<th>Location</th>
					<th>Classification</th>
					<th>Area (Hectares)</th>
				</tr>
			</thead>
			<tbody>
				<tr v-if="major_watershed.length <= 0">
					<td colspan="4">No</td>
				</tr>
				<tr v-for="data in major_watershed">
					<td>{{data.name}}</td>
					<td>{{data.location}}</td>
					<td>{{data.classification}}</td>
					<td>{{data.area}}</td>
				</tr>
			</tbody>
		</table>
			<div class="row">
				<div class="col">
					<table class="table table-light table-bordered table-sm mt-1">
						<thead>
							<tr>
								<th>Classification</th>
								<th>Benificial Use</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Class AA</td>
								<td> Public Water Supply Class I. This class is intended primarily for waters having watersheds which are uninhabited and otherwise protected and which require only approved disinfection in order to meet the National Standards for Drinking Water (NSDW) of the Philippines.</td>
							</tr>
							<tr>
								<td>Class A </td>
								<td>
									Public Water Supply Class II. For sources of water supply that will require complete treatment (coagulation, sedimentation, filtration and disinfection) in order to meet the NSDW.
								</td>
							</tr>
							<tr>
								<td>Class B</td>
								<td>Recreational Water Class I. For primary contact recreation such as bathing, swimming, skin diving, etc. (particularly those designated for tourism purposes).</td>
							</tr>
							<tr>
								<td>Class C</td>
								<td>
									<ol>
										<li>Fishery Water for the propagation and growth of fish and other aquatic resources;
										</li>
										<li>Recreational Water Class II (Boatings, etc.)</li>
										<li>Industrial Water Supply Class I (For manufacturing processes after treatment).</li>
									</ol>
								</td>
							</tr>
							<tr>
								<td>Class D</td>
								<td>
									<ol>
										<li>For agriculture, irrigation, livestock watering, etc.</li>
										<li>Industrial Water Supply Class II (e.g. cooling, etc.)</li>
										<li>Other inland waters, by their quality, belong to this classification.</li>
									</ol>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
	</div>
</template>
<script>
	export default{
		props:["year"],
		data:function(){
			return {
				form: {
					name: '',
					location: '',
					classification: '',
					area: '',
					year: '',
				},
				major_watershed: [],
				updateInfo: false,
			}
		},
		watch:{
			'form.year': function(val, oldVal){
				this.getInfoWithYear(val)
			}
		},
		mounted: function(){
			this.getInfo();
		},
		methods:{
			getInfo: function(){
				var vm = this;

				axios.post('/major_watershed/get')
						.then(data => {
							vm.major_watershed = data.data;
						})	
			},
			submitInfo: function(){
				var vm = this;

				if(!vm.updateInfo)
				{
					axios.post('/major_watershed/create', vm.form)
						.then(data => {
							vm.clearForm(vm.form.year)
							vm.getInfoWithYear(vm.form.year)
						});
				}else{
					axios.post('/major_watershed/update', vm.form)
						.then(data => {
							vm.clearForm(vm.form.year)
							vm.getInfoWithYear(vm.form.year)
						});
				}
			},
			clearForm: function(year)
			{
				var vm = this;
				vm.form = {
					name: '',
					location: '',
					classification: '',
					area: '',
					year: year,
				}
			},
			getInfoWithYear: function(year){
				var vm = this;
				axios.post('/major_watershed/get', {year: year})
						.then(data => {
							vm.major_watershed = data.data;
						})	
			},
			updateWatershed: function(info)
			{
				this.form = info;
				this.updateInfo = true;
			},
			deleteWaterShed: function(id, year)
			{
				var vm = this;
				axios.post('/major_watershed/delete',{id: id})
						.then(data => {
							console.log(data);
							vm.getInfoWithYear(year)
						})
			}
		},
		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},

	}
</script>