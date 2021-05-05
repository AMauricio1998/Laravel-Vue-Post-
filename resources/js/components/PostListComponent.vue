<template>

    <div>
        <div class="card mt-3"  v-for="post in posts"  :key="post.title">
                <!-- concatenar archivos estaticos -->
                <img :src=" '/images/' + post.image" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ post.title }}</h5>
                  <p class="card-text">{{ post.content }}</p>
                  <button class="btn btn-primary" v-on:click="postClick(post)">Ver resumen</button>
                  <router-link class="btn btn-success" :to=" 'detail/' + post.id ">Ver</router-link> 
                </div>
              </div>
        <modal-post :post="postSelected"></modal-post>
    </div>

</template>

<script>
export default {

    methods: {
        postClick: function(p){
            this.postSelected = p;
        }
    },

    data: function () {
      return {
        postSelected: "",
        posts: [
            {
                id: 1, 
                title: 'titulo 10000000', 
                image: '1617231748.png', 
                content: 'Cards support a wide variety of content, including images, text, list groups, links, and more. Below are examples of what’s supported.0', 
            },
            {
                id: 2,
                title: 'titulo 2', 
                image: '1617231748.png', 
                content: 'Cards support a wide variety of content, including images, text, list groups, links, and more. Below are examples of what’s supported.0', 
            },
            {
                id: 3,
                title: 'titulo 3', 
                image: '1617231748.png', 
                content: 'Cards support a wide variety of content, including images, text, list groups, links, and more. Below are examples of what’s supported.0', 
            },
            {
                id: 4,
                title: 'titulo 4', 
                image: '1617231748.png', 
                content: 'Cards support a wide variety of content, including images, text, list groups, links, and more. Below are examples of what’s supported.0', 
            },
            {
                id: 5,
                title: 'titulo 5', 
                image: '1617231748.png', 
                content: 'Cards support a wide variety of content, including images, text, list groups, links, and more. Below are examples of what’s supported.0', 
            },
        ]
      };
    },
}
</script>