<template>

<div class="col-8 offset-2">
  <div class="card">
    <div class="card-header">Hola</div>
    <div class="card-body">

      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="">Nombre</span>
        </div>
          <input type="text" class="form-control">
      </div>
      
      <div class="input-group mt-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="">Apellido</span>
        </div>
          <input type="text" class="form-control">
      </div>

      <div class="input-group mt-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="">Email</span>
        </div>
          <input type="email" class="form-control">
      </div>

      <div class="input-group mt-3">
        <textarea class="form-control" cols="30" rows="10" placeholder="Comentarios"></textarea>
      </div>

      <button class="btn btn-primary float-right mt-3 btn-lg"> Enviar</button>

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

          return;
        // fetch("http://larablog.test/api/post/" + this.$route.params.id)
        // .then(response => response.json())
        // .then(json => (this.post = json.data));
     }
    },
    
    data: function () {
      return {
        postSelected: "",
        post:""
    };
  }
};
</script>