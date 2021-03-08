
import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./views/Home.vue";
// import BlogPost1 from "./views/BlogPost1.vue";
// import BlogPost2 from "./views/BlogPost2.vue";
import NotFound from './views/NotFound.vue';
import BlogPost from './views/BlogPost.vue';
import BlogList from "./views/BlogList.vue";
Vue.use(VueRouter);

const routes = [
    { path: "/", component: Home, name: "home" },
    // { path: "/blog-post-1", component: BlogPost1, name: "post1" },
    // { path: "/blog-post-2", component: BlogPost2, name: "post2" },
    {path: '/blog/:id', component: BlogPost, name: 'blog', props:true},
    { path: "/blog/", component: BlogList, name: "blog-list" },
    { path: '*', component:NotFound }
];

const router = new VueRouter({
    mode: 'history',
    routes,
});

export default router;