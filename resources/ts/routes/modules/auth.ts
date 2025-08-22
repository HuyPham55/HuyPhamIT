"use strict";
import AuthLayout from "@/layout/AuthLayout.vue";
import Login from "@/pages/auth/login/Login.vue";
import Register from "@/pages/auth/login/register/Register.vue";

const authRoutes = {
    path: '/auth',
    component: AuthLayout,
    children: [
        {
            path: 'login',
            component: Login,
            name: 'login',
            meta: {
                guest: true,
                isAuth: true, // is auth route or not
            }
        },
        {
            path: 'register',
            component: Register,
            name: 'register',
            meta: {
                guest: true,
                isAuth: true, // is auth route or not
            }
        },
    ]
};

export default authRoutes
