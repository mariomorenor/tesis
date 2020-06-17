
require('./bootstrap');

window.Vue = require('vue');
window.Swal = require('sweetalert2');
window.moment = require('moment');
require('moment/locale/es')
 

import Vuex from 'vuex';
import router from './Routes';
import { sync } from 'vuex-router-sync';


Vue.use(Vuex)

Vue.component('sidebar-component', require('./components/sidebarComponent').default);
Vue.component('app-component', require('./components/App').default);
// Vue.component('silo-component', require('./components/SiloComponent').default);

let url = window.location.origin;
let port = 8081;

window.socket = io('http://tesis.test'+':'+port);

// $(function () {
//     socket.emit('temperatura');
//   })



const store = new Vuex.Store({
    state: {
        autenticated: false,
        menuOpened: false,
        productionActive:false,
        // Variables Control Index
        cantidadComedero:'',
        cantidadMinComedero:'',
        cantidadSilo:'',
        cantidadMinSilo:'',
        tempMax:'',
        tempMin:'',
        temperaturaActual:'',
        id_lote:''
    },
    mutations: {
        checkUser(state) {
            axios.get('check')
                .then((response) => {
                    if (response.data == 1) {
                        state.autenticated = true;
                      
                        router.push({
                            name: 'control_lote_index'
                        });
                    } else {
                        state.autenticated = false
                        router.push({
                            name: 'login'
                        })
                    }
                })
                .catch((e) => {
                    console.log(e.response)
                });    
        },
        openMenu(state, isActive = false) {
            if (isActive) {
                $('.content').removeClass('openMenu')
            }else{
                $('.content').toggleClass('openMenu');
            }
        }, 
        checkLote(state){
            axios.get('checkControlLote').then(({data})=>{
                // console.log(data[0].id)
                axios.get('show_control_lote/'+data[0].id).then(({data})=>{
                    // console.log(data)
                        state.cantidadComedero = data.lote.quantity_feeder;
                        state.cantidadMinComedero = data.lote.min_quantity_feeder;
                        state.cantidadSilo = data.lote.quantity_Silo;
                        state.cantidadMinSilo = data.lote.min_quantity_Silo;
                        state.tempMax = data.temp.Max;
                        state.tempMin = data.temp.Min;
                        state.productionActive = data.lote.active;
                        state.id_lote = data.lote.id
                        }).catch((e)=>{
                            console.log(e.response);
                        });
                })
                .catch(({response})=>{
                    console.log(response)
                    if (response ) {
                        router.push({name:'control_lote_init'});
                    }
                });

        },
        controlInit(state){
            socket = io('http://tesis.test'+':'+port);
            socket.emit('temperatura');
            axios.post('initControl/'+state.id_lote,{
                action: true
            }).then((data)=>{
                console.log(data)
            }).catch((e)=>{
                console.log(e.response)
            })
            socket.on('responseTemp',(msg)=> {

                      });

        },
        stop(state){
            Swal.fire({
                icon: 'warning',
                title: 'Detener El Sistema?',
                showCancelButton: true,

            }).then((result)=>{
                if (result.value) {
                    axios.post('initControl/'+state.id_lote,{
                        action: false
                    }).then((data)=>{
                    
                    }).catch((e)=>{
                        console.log(e.response)
                    })
                    socket.close();
                    state.productionActive = false
                }
            })
        }


    }
});

const unsync = sync(store, router)

const app = new Vue({
    el: '#app',
    router,
    store,
    mounted() {
        // this.$store.commit('checkLote');
        
        axios.get('isActive').then((data)=>{
            console.log(data)
            // this.$store.commit('controlInit');
        }).catch((e)=>{
            console.log(e.response)
        })

    },
    methods: {

    },

});



