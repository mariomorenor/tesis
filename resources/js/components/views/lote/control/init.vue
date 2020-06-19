<template>
  <div>
          <div class="container">
        <div class="row">
            <div class="col-7 mt-3 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <label>Sin Asignar</label>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <span class="text-dark">
                                No se está controlando ningún lote por favor, seleccione uno de los lotes disponibles o 
                                ingrese uno nuevo, para ingresar un nuevo lote, 
                                <button @click="$store.commit('openMenu',true)" data-backdrop="static" data-toggle="modal" data-target="#add_new_lote" class="btn btn-primary">
                                    presione aquí
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

<!-- Modal -->
<div class="modal fade" id="add_new_lote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Lote</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="form_store_lote"  method="post">
              <div class="container">
                  <div class="row">
                      <div class="col-8 mx-auto">
                          <div class="form-group">
                                <label for="date">Fecha:</label>
                                <input type="text" readonly id="date" class="form-control">
                          </div>
                          <div class="form-group">
                              <label for="quantity">Ingrese la Cantidad Inicial de Aves:</label>
                              <input type="number" placeholder="Número de Pollos" name="quantity" v-model="quantity" required class="form-control" min="1">
                          </div>
                          <div class="form-group">
                              <label for="quantity">Ingrese la Cantidad Inicial de Alimento:</label>
                              <input type="number" placeholder="Kg." v-model="feed" name="feed" required class="form-control" min="1">
                          </div>
                          <div class="form-group">
                              <label for="observation">Observación:</label>
                              <textarea placeholder="Observaciones sobre el lote..." v-model="observation" class="form-control" name="observation" id="observation" cols="30" rows="3"></textarea>
                          </div>
                      </div>
                  </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" @click="storeLote()" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            date_in:'',
            quantity:'',
            feed:'',
            observation:''
        }
    },
methods: {
    storeLote(){
        let fecha =  moment(Date()).format('YYYY-MM-DD');
        axios.post('store_lote',{
            date_in: fecha,
            quantity: this.quantity,
            feed: this.feed,
            observation: this.observation
        })
        .then((response)=>{
            console.log(response);
            if (response.status == 200) {
                $('#add_new_lote').modal('hide')
                this.$router.push({name:'control_lote_index'});
            }
        })
        .catch((e)=>{
            console.log(e.response)
        });
    }
        
},
mounted() {
    $("#date").val(moment().format('LL'));
},
}
</script>

<style>

</style>