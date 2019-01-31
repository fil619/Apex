import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
window.Vue = require('vue');
require('./bootstrap');

import Indirect from './components/Indirect'
import Direct from './components/Direct'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/indirect',
            name: 'indirect',
            component: Indirect
        },
        {
            path: '/direct',
            name: 'direct',
            component: Direct
        },
    ],
});

 Vue.component('example', require('./components/Example.vue'));
Vue.component('posts', require('./components/Post.vue'));
Vue.component('indirect', require('./components/Indirect.vue'));
Vue.component('direct', require('./components/Direct.vue'));

const app = new Vue({
    el: '#app',
    router
});
