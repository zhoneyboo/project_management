<template>
	<tr>
		<td>TOTAL</td>
		<td v-for="total in computeObject">
			<currency_label :data="total.total"></currency_label>
		</td>
	</tr>
</template>
<script>
	export default{
		props: ["data", "objectKey"],
		computed: {
			computeObject: {
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
	            },
				get:function(){
					var total = {};
					for(var municipality in this.data)
					{
						for(var item in this.data[municipality])
						{
							if(typeof total[item] === "undefined")
							{
								total[item] = {total: 0};
							}
							total[item]["total"] += parseFloat(this.data[municipality][item].quantity);
						}
					}
					return total;
				}
			}
		}
	}
</script>