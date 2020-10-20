require('../bootstrap');
import Vue from 'vue';
import Application from "./Application";

const app = new Vue({
  el: '#brick-main',
  render: h => h(Application),
})

app.$mount();
