<template>
	<div id="geographical_zone_surface">
			<div class="card">
				<div class="card-body pl-4 pt-3 pb-3">
					<h5 class="font-weight-bold">Geographical Zone Surfaces</h5>
					<small><b>Source:</b> Provincial Environment and Natural Resources Office, 2017</small>
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
			<div class="card mt-1">
				<div class="card-body">
					<div class="form-group">
						<label for="">Coastal Areas</label>
						<input type="text" class="form-control" v-model="geographical_zone_surface.coastal_area">
					</div>
					<div class="form-group">
						<label for="">Lakes Areas</label>
						<input type="text" class="form-control" v-model="geographical_zone_surface.lake_areas">
					</div>

					<div class="form-group">
						<label>Raparian areas, rich fertile valleys and mountainous areas</label>
						<input type="text" class="form-control" v-model="geographical_zone_surface.total_land_mass">
					</div>
				</div>
			</div>
	</div>
</template>

<script>
	export default{
		data:function(){
			return{
				geographical_zone_surface: {
					coastal_area: '',
					lake_areas: '',
					total_land_mass: '',
					year: new Date().getFullYear(),
				},
				year: new Date().getFullYear(),
			}
		},
		mounted: function(){
			this.getInfo();
		},
		methods: {
			getInfo:function(year){
				var vm = this;
				axios.post('/geographical_zone_surface/get', {year: year})
						.then(data => {
							vm.geographical_zone_surface = data.data;
						})
			},
			updateInfo: function(){
				var vm = this;
				axios.post('/geographical_zone_surface/update', vm.geographical_zone_surface)
					.then(data => {
						vm.$toastr('success', 'Information is now update!', 'Geographical Zone Surfaces')
					})

			}
		},

		computed: {
			defaultYear: function(){
				return this.$store.state.YEAR;
			}
		},
		watch: {
			'year' :function(val)
			{
				if(val == "" || val == null)
				{
					this.getInfo();
				}else{
					this.getInfo(val);
				}
			}
		}
	}
</script>