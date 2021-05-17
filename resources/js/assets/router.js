window.Vue = require('vue');
import Vue from 'vue';
import VueRouter from 'vue-router'

import PostList from '../components/PostListComponent.vue'
import PostDetail from '../components/PostDetailComponent.vue'
import PostCategory from '../components/PostCategoryComponent.vue'
import CategoryListDefault from '../components/CategoryListDefaultComponent.vue'

import Contact from '../components/ContactComponent.vue'

    Vue.use(VueRouter);

  export default new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: PostList, name: "List" },  
        { path: '/categories', component: CategoryListDefault, name: "list-category" },  
        { path: '/detail/:id', component: PostDetail, name:"detail" },  
        { path: '/post-category/:category_id', component: PostCategory, name:"post-category" },  
        { path: '/contact', component: Contact, name: "contact" },  
      ]
  });