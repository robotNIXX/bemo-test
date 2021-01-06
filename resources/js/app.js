window.Vue = Vue

import './bootstrap'
import 'es6-promise/auto'

import httpConfig from './app/config/http/index'
import store from "./app/stores/index"
import vmodal from 'vue-js-modal'
Vue.use(vmodal, { dialog: true })

import Vue from 'vue'

import App from './app/App'

// Load Index
Vue.component('app', App)

const app = new Vue({
    el: '#app',
    http: httpConfig,
    store
});
