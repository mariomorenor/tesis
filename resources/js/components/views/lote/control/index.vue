<template>
  <div class="container">
      <div class="row pt-3">
          <div class="col-3 mx-auto">
                <div class="form-group d-flex justify-content-center">
                  <img src="/img/main/power.png" @click="togglePower()" data-toggle="tooltip" v-show="!$store.state.productionActive" data-placement="bottom" title="Apagar" class="btnPower" alt="powerOn">
                  <img src="/img/main/powerOff.png" class="btnPower" @click="togglePower()" v-show="$store.state.productionActive" alt="powerOff">
                </div>
          </div>
      </div>
      <div class="row">
          <div class="col-4 px-0">
              <div class="ml-auto">
                  <div id="silo" class="silo-progressbar"></div>
              </div>
          </div>
          <div class="col-5 px-0">
              <div class="row">
                  <div class="col">
                      <div class="form-group">
                          <label>Cantidad del Comedero: </label>
                          <div class="d-flex">
                              <input v-model="$store.state.cantidadComedero" type="text" class="form-control text-center text-success font-weight-bold" readonly>
                              <label class="my-auto ml-2">Kg.</label>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group">
                          <label>Cantidad mínima Comedero: </label>
                          <div class="d-flex">
                              <input v-model="$store.state.cantidadMinComedero" type="text" class="form-control text-center text-success font-weight-bold"
                                  readonly>
                              <label class="my-auto ml-2">Kg.</label>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col">
                      <div class="form-group">
                          <label>Cantidad del Silo: </label>
                          <div class="d-flex">
                              <input v-model="$store.state.cantidadSilo" type="text" class="form-control text-center text-success font-weight-bold" readonly>
                              <label class="my-auto ml-2">Kg.</label>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group">
                          <label>Cantidad min. Silo: </label>
                          <div class="d-flex">
                              <input v-model="$store.state.cantidadMinSilo" type="text" class="form-control text-center text-success font-weight-bold" readonly>
                              <label class="my-auto ml-2">Kg.</label>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col">
                      <div class="form-group">
                          <label>Temperatura Máxima: </label>
                          <div class="d-flex">
                              <input v-model="$store.state.tempMax" type="text" class="form-control text-center text-success font-weight-bold" readonly>
                              <label class="my-auto ml-2">ºC</label>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group">
                          <label>Temperatura Mínima: </label>
                          <div class="d-flex">
                              <input v-model="$store.state.tempMin" type="text"  class="form-control text-center text-success font-weight-bold" readonly>
                              <label class="my-auto ml-2">ºC</label>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <button data-toggle="modal" data-target="#modal_lossesConfig" data-backdrop="false"
                      class="btn btn-primary btn-block shadow">Agregar Unidades Perdidas</button>
              </div>
          </div>
          <div class="col-3 px-0">
              <div class="ml-auto">
                  <div id="termo" class="silo-progressbar"></div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
data() {
    return {
        

        
    }
},
created() {
    // this.checkLote();
    this.$store.commit('checkLote')
},

methods: {
    checkLote(){
        axios.get('checkControlLote').then(({data})=>{
            axios.get('show_control_lote/'+data[0].id).then(({data})=>{
            console.log(data)
                    this.cantidadComedero = data.quantity_feeder;
                    this.cantidadMinComedero = data.min_quantity_feeder;
                    this.cantidadSilo = data.quantity_Silo;
                    this.cantidadMinSilo = data.min_quantity_Silo;
                    this.tempMax = data.max_temp;
                    this.tempMin = data.min_temp;
                    }).catch((e)=>{
                        console.log(e);
                    });
            })
            .catch(({response})=>{
                if (response.data.error.message == 'Lote not found' ) {
                    this.$router.push({name:'control_lote_init'});
                }
            });
    },
   
    togglePower(){
        
        if (!this.$store.state.productionActive) {
            this.$store.state.productionActive= true;
            
           this.$store.commit('controlInit')
            this.calibrar()
            this.initControl();
        }else{
             this.$store.commit('stop')
               
        }



     
    },
    initControl(){   
            var maximaTemperatura;
            var minimaTemperatura;
            axios.get('temp').then(({data})=>{
            
                maximaTemperatura = data[0].tempMax;
                minimaTemperatura = data[0].tempMin;
            }).catch((e)=>{
                console.log(e.response)
            })
                     
         
                   socket.on('responseTemp',(msg)=> {
                this.termo.value(msg);
                if(msg<=minimaTemperatura){
                    socket.emit('FanOff');
                }
                 if(msg>=maximaTemperatura){
                    socket.emit('FanOn');
                }
                });
                
          
    },
    calibrar(){

        let cont = 0;
        let contTemp = 0;
        let time = 3;
        var that = this;

      let  calib = setInterval(function(){
            that.silo.value(cont);
            if(cont < 100){
                cont++
            }else{
                cont=0;
                time--;
            }
                 if(time == 0){
                clearInterval(calib);
                that.silo.value(0)
            }
            
        },10)

    //   let  calibTemp = setInterval(function(){
    //         that.termo.value(contTemp);
    //         if(contTemp < 100){
    //             contTemp++
    //         }else{
    //             contTemp=0;
    //             time--;
    //         }
    //              if(time == 0){
    //             clearInterval(calibTemp);
    //             that.termo.value(0)
    //         }
            
    //     },100)
        this.initControl()
        
    },

},
mounted() {
            this.silo = new Silo("silo", "/img/silo/silo.png", {height: 454, width: 300}, {bottom: 73, height: 337});
            this.silo.value(0)

           this.termo = new Termometro("termo", "/img/termometro/termometro.png", {height: 1200, width: 300}, {bottom: 40, height: 1080}, 0.4);
           if (this.$store.state.productionActive) {
                this.initControl()
           }
           
},


}
</script>

<style>
.btnPower{
    width: 4rem;
    transition: all 0.3s;
    
}
.btnPower:hover{
    cursor: pointer;
    transform: scale(1.3);
}
</style>