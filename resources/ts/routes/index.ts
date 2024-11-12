import Home from "@/pages/home/Home.vue";
import PostDetail from "@/pages/post-detail/PostDetail.vue";
import PostIndex from "@/pages/post-index/PostIndex.vue";
import ContactUs from "@/pages/contact-us/ContactUs.vue";
import NotFound from "@/errors/NotFound.vue";
import Layout from "@/layout/Layout.vue";
import authRoutes from "@/routes/modules/auth";

const routes = [
    {
        path: '/',
        component: Layout,
        children: [
            {
                path: '/',
                component: Home,
                name: 'home',
            },
            {
                path: '/post-list', //Route paths should start with a "/": "post-detail" should be "/post-detail"
                component: PostIndex,
                name: 'post_list',
            },
            {
                path: '/post-detail/:hash', //Route paths should start with a "/": "post-detail" should be "/post-detail"
                component: PostDetail,
                name: 'post_detail',
            },
            {
                path: '/contact-us',
                component: ContactUs,
                name: 'contact_us',
            },
        ]
    },
    // will match everything and put it under `route.params.pathMatch`
    authRoutes,
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFound
    },
];

export default routes
