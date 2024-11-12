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
        },
        {
            path: 'register',
            component: Register,
            name: 'register',
        },
    ]
};

export default authRoutes
