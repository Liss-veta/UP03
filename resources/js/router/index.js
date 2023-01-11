import { createRouter, createWebHistory } from "vue-router";
import MainView from '../views/main/MainView.vue';
import RegisterComponent from '../components/autorization/RegisterComponent.vue';
import LoginComponent from '../components/autorization/LoginComponent.vue';
// import GetComponent from '../components/GetComponent.vue';
import DashboardComponent from '../components/autorization/DashboardComponent.vue';
import MessageView from '../views/message/MessageView.vue';
import FriendsView from '../views/friends/FriendsView.vue';
import FriendProfileView from '../views/friends/FriendProfileView.vue';
import AdminView from '../views/admin/AdminView.vue';
import ProfileView from '../views/profile/ProfileView.vue';

const router = new createRouter({
    base: "/",
    history: createWebHistory(),
    routes: [
        { path: "/", component: RegisterComponent },
        { path: "/register", component: RegisterComponent },
        { path: "/login", component: LoginComponent },
        // { path: "/get", component: GetComponent},
        { path: "/dashboard", component: DashboardComponent },
        { path: "/message", component: MessageView },
        { path: "/admin", component: AdminView },
        { path: "/profile", component: ProfileView },
        { path: "/friends", component: FriendsView },
        { path: "/user/id", component: FriendProfileView}
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
