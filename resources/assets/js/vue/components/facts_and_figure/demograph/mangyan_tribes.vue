<template>
	<div id="mangyan_tribes">
		<div class="card">
			<div class="card-body pl-4 pt-3 pb-3">
				<h5 class="font-weight-bold">Mangyan Tribes</h5>
			</div>
		</div>

		<div class="row mt-1">
			<div class="col-md-6">
				<ul class="list-group">
					<template v-for="item in mangyan_tribes">
						<li class="list-group-item">
							<h5 class="font-weight-bold text-uppercase">{{item.mangyan_tribe}}</h5>
							<p>{{item.description}}</p>
						</li>
					</template>
					<template v-if="mangyan_tribes.length <= 0">
						<li class="list-group-item">No item found!</li>
					</template>
				</ul>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		data: function(){
			return {
				mangyan_tribes: [],
				form: {
					mangyan_tribe: '',
					description: '',
				},
			}
		},
		methods: {
			getInfo: function(){
				var vm = this;
				axios.post('/demograph/mangyan_tribes/get')
						.then(data => {
							vm.mangyan_tribes = data.data;
						})
			},
		},
		mounted: function(){
			this.getInfo();
		}
	}
</script>