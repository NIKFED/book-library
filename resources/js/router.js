import Vue from 'vue';
import VueRouter from 'vue-router';
import BookList from './components/BookList';
import Book from './components/Book';
import DictionaryList from "./components/dictionary/DictionaryList";

Vue.use(VueRouter);

const routes = [
    { path: '/book-list', component: BookList },
    { path: '/book/:bookId', component: Book },
    { path: '/dictionary-list/:dictionaryName', component: DictionaryList }
];

const router = new VueRouter({
    routes,
})

export default router;