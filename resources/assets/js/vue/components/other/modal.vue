<template>
	<div 	class="modal fade" 
			:id="id" 
			tabindex="-1" 
			data-backdrop="static"
			role="dialog" 
			aria-labelledby="exampleModalLabel" 
			aria-hidden="true">
		<div 	class="modal-dialog modal-dialog-centered" 
		  		role="document"
		  		:class="modal_class">
			<div class="modal-content">

			    <div class="modal-header" v-if="header != 'false'">
			        <h5 class="modal-title" 
			        	id="exampleModalLabel">{{title}}
			    	</h5>
			        <button type="button" 
					        class="close" 
					        data-dismiss="modal" 
					        aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			    </div>

			    <slot name="modal-header"></slot>


			    <div class="modal-body">
					<!-- MODAL CONTENT -->
					<slot name="modal-body"></slot>
			    </div>
			    <div class="modal-footer" v-if="footer != 'false'">
			        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>

			        <button type="button" 
					        class="btn btn-primary btn-sm" 
					        @click="success"
					        v-if="positive_button == null || 
					        positive_button == undefined ||
					         positive_button == ''">
					     Save changes
			 		</button>

			 		<button type="button" 
					        class="btn btn-primary btn-sm" 
					        @click="success"
					        v-if="positive_button != null || 
					        positive_button != undefined ||
					         positive_button != ''">
					     {{positive_button}}
			 		</button>
			     </div>

			    <slot name="modal-footer"></slot>

			    <slot name="other"></slot>
		    </div>
		</div>
	</div>
</template>
<script>
	export default{
		props: ['id','title', 'footer', 'header','positive_button', "large"],
		data: function(){
			return {
				modal_class: ""
			}
		},
		methods: {
			success:function(){
				this.$emit('success','success');
				$('#' + this.id).modal('hide');
			}
		},
		mounted: function(){
			if(this.large == "true" || this.large)
			{
				this.modal_class = "modal-lg";
			}
		}
	}
</script>