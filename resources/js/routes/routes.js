import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
import Post from '../components/Posts.vue';
import AdminIndex from '../components/admin/AdminIndex.vue';
// import AddPost from '../components/admin/AddPost.vue';
const routes =[
    {path:'/',component : Post , name : 'Post'},
    {path:'/admin',component : AdminIndex , name : 'AdminIndex'},
    // {path:'/admin/addpost',component : AddPost , name : 'AddPost'}
];

const router = new VueRouter(
    {routes,hashbang:false,mode:'history'}
)

export default router;
