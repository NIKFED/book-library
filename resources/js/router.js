import Vue from 'vue';
import VueRouter from 'vue-router';
import CategoryList from './components/CategoryList';
import Book from './components/Book';
import DictionaryList from "./components/dictionary/DictionaryList";

Vue.use(VueRouter);

const routes = [
    { path: '/category-list', component: CategoryList },
    { path: '/book/:bookId', component: Book },
    { path: '/dictionary-list/:dictionaryName', component: DictionaryList }
];

const router = new VueRouter({
    routes,
})

export default router;