import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import Vue from 'vue';
import App from './app.vue';
import router from './router';
import store from './store';

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

const app = new Vue({
    router,
    store,
    render: (h) => h(App),
})

store.dispatch('initialize', [

]).then(() => {
    app.$mount('#app');
});