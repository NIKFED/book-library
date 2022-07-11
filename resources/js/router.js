import Vue from 'vue';
import VueRouter from 'vue-router';
import BookLibrary from './components/BookLibrary';
import DictionaryList from "./components/dictionary/DictionaryList";

Vue.use(VueRouter);

const routes = [
    { path: '/', component: BookLibrary },
    { path: '/dictionary-list', component: DictionaryList }
];

const router = new VueRouter({
    routes,
})

export default router;