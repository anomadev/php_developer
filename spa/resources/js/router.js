import Vue from 'vue';
import VueRouter from 'vue-router';
import HomeComponent from "./views/HomeComponent";
import AboutComponent from "./views/AboutComponent";
import ArticleIndex from './views/ArticleIndex';
import MyArticles from "./views/MyArticles";
import ArticleShow from "./views/ArticleShow";
import ArticleCreate from "./views/ArticleCreate";
import ArticleEdit from "./views/ArticleEdit";
import NotFound from "./views/NotFound";

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        { path: '/home', component: HomeComponent },
        { path: '/about', component: AboutComponent },
        { path: '/articles', component: ArticleIndex },
        { path: '/my_articles', component: MyArticles },
        { path: '/articles/create', component: ArticleCreate },
        { path: '/articles/:slug/edit', component: ArticleEdit, name: 'edit' },
        { path: '/articles/:slug', component: ArticleShow, name: 'show' },
        { path: '*', component: NotFound }
    ]
});
