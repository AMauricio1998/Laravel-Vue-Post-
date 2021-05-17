<template>

    <div class="row">
      <div class="col-md-3" v-for="category in categories"  :key="category.id">
        <div class="card mt-3">
        <router-link 
        :to="{ name: 'post-category', params: {category_id: category.id} }"> 
                <!-- concatenar archivos estaticos -->
                <img src='/images_category/018-explore.svg' class="card-img-top mt-3" alt="...">
                <div class="card-body">
                  <h5 class="card-title text-center">{{ category.title }}</h5>
                </div>
          </router-link>
              </div>
        </div>
    </div>

</template>

<script>
export default {
    created(){
      this.getCategories();
    },
    methods: {
        getCategories: function(){
            fetch("http://larablog.test/api/category/all")
            .then(response => response.json())
            .then(json => (this.categories = json.data));
        },
    },

    data: function () {
      return {
        categories: ""
    };
  }
};
</script>