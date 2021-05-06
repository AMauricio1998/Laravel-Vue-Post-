window.Vue = require('vue');
import Vue from 'vue';
import VueRouter from 'vue-router'
import PostList from '../components/PostListComponent.vue'
import PostDetail from '../components/PostDetailComponent.vue'

    Vue.use(VueRouter);

  export default new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: PostList, name: "List" },  
        { path: '/detail/:id', component: PostDetail, name:"detail" },  
      ]
  });