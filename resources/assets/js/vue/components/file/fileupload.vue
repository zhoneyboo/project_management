<template>
	<div id="fileupload">

		<div class="custom-input-file">
			<input type="file" id="file" ref="files" multiple v-on:change="handleFileUpload" class="form-file-control">
			<label>Select File</label>
		</div>
		<ul class="upload-list">
			<li v-for="(item, index) in rawFile" >
				<div class="row">
					<div class="col-auto">
						<button  class="btn btn-sm btn-danger" @click="rawFile.splice(index, 1)">
							<font-awesome-icon :icon="['fas', 'times']"/>
						</button>
					</div>	

					<div class="col">
						{{item.name}}
					</div>
				</div>
			</li>
		</ul>
		<div class="row" v-if="rawFile.length >0">
			<div class="col">
				<button class="btn btn-block btn-primary" @click="uploadFile">Save File</button>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		props: ['url', 'data'],
		data: function(){
			return {
				files: '',
				rawFile: '',
				formData: '',
				base64: []
			}
		},
		methods:{
			uploadFile: function(){
				var vm = this;
				axios.post(this.url, 
						vm.callBackFiles(), 
						{
							headers: {
						        'Content-Type': 'multipart/form-data'
						    }
						})
						.then(data => {
							vm.$emit('getData', data);
							vm.files = [];
							vm.rawFile = [];
							vm.base64 = [];
						})
			},
			callBackFiles: function(){


				var formData = new FormData();
				for (var i = 0; i < this.rawFile.length; i++) {
					let file = this.rawFile[i].file;
					formData.append("files[]", file);

				}
				if(typeof this.data === 'object' && Array.isArray(this.data) === false)
				{
					for(var key in this.data)
					{
						formData.append(key, this.data[key]);
					}
				}else{
					throw "Additional upload data must be an object";
				}
				return formData;
			},
			getFileInfo: function(){
				var vm = this;
				vm.rawFile = [];
				vm.base64 = [];

				for (var i = 0; i < this.files.length; i++) {
					let file = this.files[i];

					var fileReader = new FileReader();
					var arr = [];
					fileReader.readAsDataURL(this.files[i]);
					arr = {
								type: this.files[i].type,
								name: this.files[i].name,
								lastModified: this.files[i].lastModified,
								size: this.files[i].size,
								exactSize: this.getFileSize(this.files[i].size),
								file: this.files[i],
								base64: '',
							}

					vm.rawFile.push(arr);
				}

				vm.$emit('file', vm.rawFile);
			},
			handleFileUpload: function(event){
				this.files = this.$refs.files.files;
				this.$emit('event', event);
				this.getFileInfo(this.files);
			},
			getFileSize: function(size)
			{

       			 var fSExt = new Array('Bytes', 'KB', 'MB', 'GB')
       			 var i = 0;
       			 while(size > 900)
       			 {
       			 	size /= 1024;
       			 	i++;
       			 }
       			 return (Math.round(size * 100)/100) + ' ' + fSExt[i];
			}
		}
	}
</script>