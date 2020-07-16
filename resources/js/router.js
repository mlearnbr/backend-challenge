import VueRouter from 'vue-router';
import Pages from './pages/pages.js';
import Vue from 'vue'

Vue.use(VueRouter);

const routes = [
    { path: '/', name: 'home', component: Pages.Home },
    { path: '/users', name: 'index.user', component: Pages.Users.Index, meta: { title: 'Usuários' } },
    { path: '/users/create', name: 'create.user', component: Pages.Users.Create, meta: { title: 'Criar Novo Usuário' } }
]

const router = new VueRouter({ routes })

export default router;
