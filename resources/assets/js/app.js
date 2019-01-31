import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
window.Vue = require('vue');
require('./bootstrap');

import Indirect from './components/Indirect'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/indirect',
            name: 'indirect',
            component: Indirect
        }
    ],
});

 Vue.component('example', require('./components/Example.vue'));
Vue.component('posts', require('./components/Post.vue'));
Vue.component('indirect', require('./components/Indirect.vue'));

const app = new Vue({
    el: '#app',
    router
});
