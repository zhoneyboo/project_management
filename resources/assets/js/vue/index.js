import Vue from 'vue';
import App from './view/App.vue'
import store from './store'
import router from './routes'
import components from './components'



import VuePaginate from 'vue-paginate'
Vue.use(VuePaginate)

import DatePicker from 'vue2-datepicker'
DatePicker.fecha.format(new Date(), 'YYYY-MM-DDTHH:mm:ss')
Vue.use(DatePicker);



import vSelect from 'vue-select'
Vue.component('v-select', vSelect)


import VueToastr from '@deveodk/vue-toastr'
import '@deveodk/vue-toastr/dist/@deveodk/vue-toastr.css'

Vue.use(require('vue-moment'));
import Font from './font-awesome'


import VueSweetalert2 from 'vue-sweetalert2';
var sweetalert_option = {
  confirmButtonClass: 'btn btn-success ml-1',
  cancelButtonClass: 'btn btn-danger ml-1',
  buttonsStyling: false,
};

Vue.use(VueSweetalert2, sweetalert_option);



Vue.use(VueToastr, {
    defaultPosition: 'toast-bottom-left',
    defaultType: 'info',
    defaultTimeout: 5000
});





const app = new Vue({

	el: '#app',
	template: '<app></app>',
	components: {App},
	router,
	store
})