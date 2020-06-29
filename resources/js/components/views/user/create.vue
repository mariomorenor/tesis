<template>
<<<<<<< HEAD
  
=======
      <div class="container">
          <div class="row mt-5">
              <div class="col-8 mx-auto">
                  <form method="POST" id="createFormUser" class="bg-white border rounded shadow p-2">
                      <div>
                          <h1 class="font-weight-bold">Datos Usuario</h1>
                          <div class="row">
                              <div class="col">
                                  <div class="form-group">
                                      <label for="nombre">Nombre:</label>
                                      <input autocomplete="off" type="text"  class="form-control"
                                          name="name" id="name" autofocus>
                                  </div>
                              </div>
                              <div class="col">
                                  <div class="form-group">
                                      <label for="username">Usuario:</label>
                                      <input autocomplete="off" type="text" wire:model.lazy="username"
                                          class="form-control" name="username" id="username">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <div class="form-group">
                                      <label for="password">Contraseña:</label>
                                      <input autocomplete="off" type="password" wire:model.lazy="password"
                                          class="form-control" name="password" id="password">
                                  </div>
                              </div>
                              <div class="col">
                                  <div class="form-group">
                                      <label for="password_confirmation">Confirmar:</label>
                                      <input autocomplete="off" wire:model.lazy="password_confirmation" type="password"
                                          class="form-control" name="password_confirmation" id="password_confirmation">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-4">
                                  <div class="form-group">
                                      <label for="role">Rol:</label>
                                      <select name="role" id="role">
                                          <option v-for="role in roles" :key="role.id" :value="role.name">
                                              {{role.description}}</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="row mb-2">
                              <div class="col-4 mx-auto">
                                  <button @click="guardarUsuario()" type="button" class="btn btn-success btn-block shadow">GUARDAR</button>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
>>>>>>> ab9cc6bd0a625ad6f648e297d41c497e9b1ec103
</template>

<script>
export default {
<<<<<<< HEAD

=======
    data() {
        return {
            roles:''
        }
    },
    
mounted() {
    // console.log('Holi')
    this.getRoles();
},
methods: {
    getRoles(){
        let that = this;
        $.get({
            url: '/roles',
            success: function(response){
                // console.log(response)
                that.roles = response;
            },
            error: function (error) {
                console.log(error);
              }
        })
  
    },
    guardarUsuario(){
        $.post({
            url:'/users',
            data: $('#createFormUser').serialize(),
            success: function (response) {  
                console.log(response);
                Swal.fire({
                    icon: 'success',
                    title: 'Operación realizada con éxito!',
                    timer: 1800
                })
            },
            error: function (error) {
                console.log(error);
                Swal.fire({
                    icon:'error',
                    title: 'Operación Fallida intente más tarde'
                })
              }
        });
    }
},
>>>>>>> ab9cc6bd0a625ad6f648e297d41c497e9b1ec103
}
</script>

<style>

</style>