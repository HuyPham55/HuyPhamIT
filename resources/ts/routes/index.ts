import Home from "@/pages/home/Home.vue";
import PostDetail from "@/pages/post-detail/PostDetail.vue";
import PostIndex from "@/pages/post-index/PostIndex.vue";
import ContactUs from "@/pages/contact-us/ContactUs.vue";
import NotFound from "@/errors/NotFound.vue";
import Layout from "@/layout/Layout.vue";
import authRoutes from "@/routes/modules/auth";
import ServerError from "@/errors/ServerError.vue";

const routes = [
    {
        path: '/',
        component: Layout,
        redirect: { name: 'home' },
        children: [
            {
                path: '/home',
                component: Home,
                name: 'home',
            },
            {
                path: '/posts', //Route paths should start with a "/": "post-detail" should be "/post-detail"
                name: 'posts',
                redirect: { name: 'post_list' },
                children: [
                    {
                        path: 'list',
                        component: PostIndex,
                        name: 'post_list',
                    },
                    {
                        path: ':hash', //Route paths should start with a "/": "post-detail" should be "/post-detail"
                        component: PostDetail,
                        name: 'post_detail',
                    },
                ],
            },
            {
                path: '/contact-us',
                component: ContactUs,
                name: 'contact_us',
            },
        ],
    },
    // will match everything and put it under `route.params.pathMatch`
    authRoutes,
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFound
    },
    {
        path: '/error',
        name: 'Error',
        component: ServerError
    },
];

export default routes
