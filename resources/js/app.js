

require('./bootstrap');


import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
//inputs file for routes
import { routes } from './routes';

import  Vue2Editor  from "vue2-editor";
Vue.use(Vue2Editor);
import vuetify from './vuetify';
//Import user class
import User from './helpers/User';
window.User = User

import Swal from 'sweetalert2'
window.Swal = Swal;

import Notification from './helpers/Notification'
window.Notification = Notification;

import JwPagination from 'jw-vue-pagination';
Vue.component('jw-pagination', JwPagination);

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

window.Toast = Toast;
window.Reload = new Vue();

const router = new VueRouter({
    routes,
    mode: 'history'
  })


const app = new Vue({
    el: '#app',
    router,
    vuetify
});
