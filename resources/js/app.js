require('./bootstrap');

// window.Vue = require('vue');

import VueRouter from 'vue-router';
import Vue from 'vue';
import VueSimpleAlert from "vue-simple-alert";
import routes from './routes';

Vue.use(VueRouter);
Vue.use(VueSimpleAlert);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});