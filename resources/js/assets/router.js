window.Vue = require('vue');
import Vue from 'vue';
import VueRouter from 'vue-router'
import PostList from '../components/PostListComponent.vue'
import PostDetail from '../components/PostDetailComponent.vue'

    Vue.use(VueRouter);

  export default new VueRouter({
    routes: [
        { path: '/', component: PostList },  
        { path: '/detail/:id', component: PostDetail },  
      ]
  });