<template>
	<div id="v-datatable">
		<div class="row justify-content-between">
			<div class="col-md-5">
				<div class="row">
					<div class="col-auto d-flex align-items-center">Search:</div>
					<div class="col">
						<input type="text" class="form-control" v-model="search">
					</div>
				</div>
			</div>
			<div class="col-md-6 d-flex align-items-center justify-content-end">
				<slot name="buttons">
					
				</slot>	
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered table-light mt-2" :class="tclass" ref="table">
				<slot name="thead">
					<thead>
						<tr>
							<template v-for="(col, index) in columnNames" >
								<th :class="responsiveClass(index)"></th>
							</template>
						</tr>
					</thead>
				</slot>
				<paginate 
					name="filteredList"
					:list="filteredList"
					:per="parseInt(list_range)"
					tag="tbody"
				>
					<tr v-for="(key, index) in paginated('filteredList')" :key="key.id">
						<template v-for="(field, inField) in fields">
							<template>
								<td :class="checkClass(inField)">
									<slot v-bind:row="key" :name="field">
										{{key[field]}}
									</slot>
								</td>
							</template>
						</template>
						<template v-for="(item, name) in key"  v-if="fields.length <= 0">
							<td>
								<slot v-bind:row="key" :name="name">
									{{item}}
								</slot>
							</td>
						</template>
						
						<td v-for="other in otherFields" class="text-center">
							<slot v-bind:row="key" :name="other">
								{{other}}
							</slot>
						</td>
					</tr>
					<tr v-if="filteredList.length <= 0">
						<td class="text-center p-2" :colspan="fields.length + otherFields.length">
							No item found.
						</td>
					</tr>
				</paginate>

			</table>
		</div>
		<div class="row justify-content-between">
			<div class="col-md-auto">
				<div class="row" 
				    v-if="filteredList.length > 0">
					<div class="col-auto d-flex align-items-center p-0 pl-3">
						<p><b>Show list:</b></p>
					</div>
					<div class="col-auto pl-2">
						<select class="form-control form-control-sm" v-model="list_range">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="100">100</option>
						</select>
					</div>

					<div class="col-auto">
						<p><b>Number of item found: {{filteredList.length}}</b></p>
					</div>
				</div>
			</div>
			<div class="col-md-auto">
				<paginate-links for="filteredList"
				    v-if="filteredList.length > 0"
					:show-step-links="true"
					:limit="5"
					:classes="{
					    'ul': 'pagination',
					    'li' : 'page-item',
					    'a' : 'page-link',
					    '.next > a': 'next-link',
					    '.prev > a': ['prev-link', 'another-class']
					  }">
				</paginate-links>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		props: [
					'data',
					'columnNames',
					'searchable',
					'otherFields',
					'centerField',
					'rightField',
					'tclass',
					'responsiveColumn',
					'fields'
				],
		data:function(){
			return {
			    paginate: ['filteredList'],
			    search: '',
			    list_range: 10
			}
		},
		methods:{
			checkClass: function(val){
				return this.textPosition(val);			
			},
			textPosition: function(val){
				if(!!this.centerField == true)
				{
					if(this.centerField.includes(val))
					{
						return 'text-center'
					}
				}
				if(!!this.rightField == true)
				{
					if(this.rightField.includes(val))
					{
						return 'text-right'
					}
				}

				return "";
			},
		},
		mounted: function(){

		},
		computed:{
			filteredList: function()
			{
				var vm = this;
				var searchable = [];
				if(vm.searchable || vm.searchable != undefined)
				{
					searchable = vm.searchable;
				}else{
					searchable = vm.fields;
				}
				return this.data.filter(data => {
					for (var i = searchable.length - 1; i >= 0; i--) {
						if(data[searchable[i]])
						{
							if(data[searchable[i].toString().toLowerCase()]
															.toString()
															.toLowerCase()
															.includes(vm.search.toString().toLowerCase()))
							{
								return data[searchable[i].toString().toLowerCase()]
															.toString()
															.toLowerCase()
															.includes(vm.search.toString().toLowerCase());
							}
						}
					}
					vm.$forceUpdate();
				})

			}

		},

	}
</script>