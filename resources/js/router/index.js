import { createRouter, createWebHistory } from "vue-router";
import MainView from '../views/main/MainView.vue';
import RegisterComponent from '../components/autorization/RegisterComponent.vue';
import LoginComponent from '../components/autorization/LoginComponent.vue';
// import GetComponent from '../components/GetComponent.vue';
import DashboardComponent from '../components/autorization/DashboardComponent.vue';
import AboutView from '../views/about/AboutView.vue';
import AdminView from '../views/admin/AdminView.vue';
import MenuView from '../views/menu/MenuView.vue';

const router = new createRouter({
    base: "/register",
    history: createWebHistory(),
    routes: [
        { path: "/", component: MainView },
        { path: "/register", component: RegisterComponent },
        { path: "/login", component: LoginComponent },
        // { path: "/get", component: GetComponent},
        { path: "/dashboard", component: DashboardComponent },
        { path: "/about", component: AboutView },
        { path: "/admin", component: AdminView },
        { path: "/menu", component: MenuView }
    ],
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token')

    if (!token && to.path == '/dashboard') {
        if (to.path === '/login' || to.path === '/register') {
            return next();
        } else {
            return next({
                path: '/login'
            })
        }
    }

    if ((to.path === '/login' || to.path === '/register') && token) {
        return next({
            path: '/dashboard'
        })
    }

    next()
})

export default router;
