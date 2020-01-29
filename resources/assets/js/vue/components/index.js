require('./facts_and_figure')

import Vue from 'vue';
import navbar from './layouts/nav.vue'
import sidenav from './layouts/sidenav.vue'



import modal from './other/modal.vue'
import dtable from './other/table.vue'
import currency_input from './other/currency_input.vue'
import currency_label from './other/currency_label.vue'
// Components

//Chart

import PieChart from './chart/Pie.vue'


import FileUpload from './file/fileupload.vue'
Vue.component('fileupload', FileUpload);


Vue.component('navbar', navbar);
Vue.component('sidenav', sidenav);

Vue.component('modal', modal);
Vue.component('v-datatable', dtable);
Vue.component('currency_input', currency_input);
Vue.component('currency_label', currency_label);


Vue.component('v-piechart', PieChart);

import sum_of_object from './other/sum_of_object.vue'
Vue.component('sum_of_object', sum_of_object);



