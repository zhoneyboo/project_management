import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import router from '../routes'

Vue.use(Vuex);

const store = new Vuex.Store({

	state: {
		USER_INFO: [],
		YEAR: [],
		ACCESS: [],
	},
	mutations:{
		SET_USER_INFORMATION : function(state, info){
			state.USER_INFO = info;
		},
		GET_YEAR: function(state)
		{
				var current_year = (new Date()).getFullYear() + 50;
				var start_year = 1969;

				var arr = [];

				for (var i = start_year; i < current_year; i++) {
					arr.push(i)
				}
				state.YEAR = arr.reverse();
		}
	},
	actions:{

	},
	getters:{

	}
})

export default store;