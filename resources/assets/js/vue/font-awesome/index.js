import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'


import { 
			faTrashAlt,
			faEdit,
			faEye
	 	} from '@fortawesome/free-regular-svg-icons'

import { 
			faLink,
			faAngleLeft,
			faBars,
			faCloudDownloadAlt,
			faTimes,
			faCaretDown
	 	} from '@fortawesome/free-solid-svg-icons'


library.add(
				faTrashAlt, 
				faEdit,
				faEye,
				faLink,
				faAngleLeft,
				faTimes,
				faBars,
				faCloudDownloadAlt,
				faCaretDown
			);

Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false