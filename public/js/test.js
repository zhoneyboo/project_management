let a = 'letter';

const axios = require('axios');



setInterval(function()
{ 
	axios.get('https://napohouston.brandfuss.com/sending-email/')
			.then(data => {
				console.log(data);
			})
}, 3000);