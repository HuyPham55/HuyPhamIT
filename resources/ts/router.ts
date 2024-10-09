import {createRouter, createWebHistory} from 'vue-router'
import Home from './pages/home/Home.vue';
import PostDetail from "./pages/post-detail/PostDetail.vue";
import PostIndex from "@/pages/post-index/PostIndex.vue";

const routes = [
    {
        path: '/',
        component: Home,
        name: 'home',
    },
    {
        path: '/post-detail', //Route paths should start with a "/": "post-detail" should be "/post-detail"
        component: PostDetail,
        name: 'post_detail',
    },
    {
        path: '/post-list', //Route paths should start with a "/": "post-detail" should be "/post-detail"
        component: PostIndex,
        name: 'post_list',
    }
];
const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'active',
    routes,
})

export default router;