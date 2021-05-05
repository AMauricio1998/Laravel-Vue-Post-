<template>

<div>
    <div v-if="post">
        <div class="card mt-3">
                <!-- concatenar archivos estaticos -->
                <div class="card-header">
                    <img :src=" '/images/' + post.image" class="card-img-top">
                </div>

                <div class="card-body">
                  <h1 lass="card-title">{{ post.title }}</h1>
                  <p class="card-text">{{ post.content }}</p>
                </div>
              </div>
    </div>
    <div v-else>
        <h1>El post no existe</h1>
    </div>
</div>

</template>

<script>
export default {
    created(){
        console.log("Hola mundo Vue");
    },
    methods: {
        getPost: function(){
        }
    },

    data: function () {
      return {
        postSelected: "",
        post: 
            {
                title: 'titulo 10000000', 
                image: '1617231748.png', 
                content: 'Cards support a wide variety of content, including images, text, list groups, links, and more. Below are examples of what’s supported.0', 
            }
    };
  }
};
</script>