require('../bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import Application from "./Application";
import routes from './router';
import state from './store';

Vue.use(VueRouter);
Vue.use(Vuex);

const router =  new VueRouter(routes);
const store = new Vuex.Store({
  ...state,
});

const app = new Vue({
  el: '#brick-main',
  render: h => h(Application),
  store, router,
})

app.$mount();
