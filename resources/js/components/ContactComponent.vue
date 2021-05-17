<template>

<div class="col-8 offset-2">
  <div class="card">
    <div class="card-header">
                  <img src="/images/logo.png" class="logo_200 mx-auto d-block">
    </div>
    <div class="card-body">

      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="">Nombre</span>
        </div>
          <input type="text" class="form-control" v-model="name">
      </div>
      
      <div class="input-group mt-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="">Apellido</span>
        </div>
          <input type="text" class="form-control" v-model="surname">
      </div>

      <div class="input-group mt-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="">Email</span>
        </div>
          <input type="email" class="form-control" v-model="email">
      </div>

      <div class="input-group mt-3">
        <textarea class="form-control" cols="30" rows="10" placeholder="Comentarios" v-model="content"></textarea>
      </div>

      <button @click="saveContact" class="btn btn-primary float-right mt-3 btn-lg">Enviar</button>

    </div>
  </div>
</div>

</template>

<script>
export default {
    created(){
    },
    methods: {
        saveContact: function(){

          console.log(this.name+" "+this.surname+" "+this.email+" "+this.content)

          return;
        // fetch("http://larablog.test/api/post/" + this.$route.params.id)
        // .then(response => response.json())
        // .then(json => (this.post = json.data));
     }
    },
    
    data: function () {
      return {
        name: "",
        surname: "",
        email: "",
        content: "Contenido",
    };
  }
};
</script>