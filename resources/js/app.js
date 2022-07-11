require('./bootstrap');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'admin-lte/dist/css/adminlte.css';

import Vue from 'vue';
import App from './app.vue';
import router from './router';
import store from './store';
import './icons';
import adminLte from 'admin-lte';

Vue.config.productionTip = false

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

const app = new Vue({
    router,
    store,
    render: (h) => h(App),
})

store.dispatch('initialize', [
    'statuses',
    'categories',
    'authors',
]).then(() => {
    app.$mount('#app');
});