"use strict";
import {createRouter, createWebHistory} from 'vue-router'
import routes from "@/routes";
import {useAuthStore} from "@/stores/modules/auth";

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'active',
    linkExactActiveClass: 'exact-active',
    routes,
})

router.beforeEach(async (to) => {
    const auth = useAuthStore();
    if (!auth.user) {
        await auth.fetchUser();
    }

    if (to.meta.auth && !auth.user) {
        return {name: 'login'};
    }
    if (to.meta.guest && auth.user) {
        // Redirect to home if the user is authenticated and tries to access a guest route
        return {name: 'home'};
    }
});

export default router;
