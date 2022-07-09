import Vue from 'vue';
import VueRouter from 'vue-router';
import BookLibrary from './components/BookLibrary';

Vue.use(VueRouter);

const routes = [
    { path: '/', component: BookLibrary }
];

const router = new VueRouter({
    routes,
})

export default router;