<template>
	<input type="text" v-model="displayValue" @blur="isInputActive = false" @focus="isInputActive = true"/>
</template>
<script>
	export default{
		props:["value"],
		data: function() {
	        return {
	            isInputActive: false
	        }
	    },
	    computed: {
	        displayValue: {
	            get: function() {
	            	if(typeof this.value === "undefined")
                    {
                    	return "0.00";
                    }
	                if (this.isInputActive) {
	                    // Cursor is inside the input field. unformat display value for user
	                    return this.value.toString()
	                } else {
	                    // User is not modifying now. Format display value for user interface
	                   		var val = parseFloat(this.value);
	                    	return val.toFixed(2).replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1,")
	                }
	            },
	            set: function(modifiedValue) {
	                // Recalculate value after ignoring "$" and "," in user input
	                let newValue = parseFloat(modifiedValue.replace(/[^\d\.]/g, ""))
	                // Ensure that it is not NaN
	                if (isNaN(newValue)) {
	                    newValue = 0
	                }
	                // Note: we cannot set this.value as it is a "prop". It needs to be passed to parent component
	                // $emit the event so that parent component gets it
	                this.$emit('input', newValue)
	            }
	        }
	    }
	}
</script>