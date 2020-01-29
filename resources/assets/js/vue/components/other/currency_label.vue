<template>
	<span>{{displaydata}}</span>
</template>
<script>
	export default{
		props:["data"],
		computed: {
			displaydata: {
				get: function() {
	            	if(typeof this.data === "undefined")
                    {
                    	return "0.00";
                    }
	                if (this.isInputActive) {
	                    // Cursor is inside the input field. unformat display data for user
	                    return this.data.toString()
	                } else {
	                    // User is not modifying now. Format display data for user interface
	                   		var val = parseFloat(this.data);
	                    	return val.toFixed(2).replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1,")
	                }
	            },
	            set: function(modifieddata) {
	                // Recalculate data after ignoring "$" and "," in user input
	                let newdata = parseFloat(modifieddata.replace(/[^\d\.]/g, ""))
	                // Ensure that it is not NaN
	                if (isNaN(newdata)) {
	                    newdata = 0
	                }
	                // Note: we cannot set this.data as it is a "prop". It needs to be passed to parent component
	                // $emit the event so that parent component gets it
	                this.$emit('input', newdata)
	            }
			}
		}
	}
</script>