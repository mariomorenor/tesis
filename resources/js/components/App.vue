<template>
  <div>
      <sidebar-component></sidebar-component>
      <div class="content ">
        <img @click="$store.commit('openMenu')" src="img/main/menu.png" id="btnMenuSideBar" class="menu-bar" alt="Menú" v-show="$store.state.autenticated" >
        <transition>
            <router-view></router-view>
        </transition>
      </div>
  </div>
</template>

<script>
export default {
    data() {
        return {

        }
    },
    mounted() {
        this.$store.commit('checkUser');
        
        // this.$store.commit('initControl')
    },
    beforeMount() {
       
          
    },
    updated() {
       
    },
    methods:{

    }
}
</script>

<style>
.content{
    position: absolute;
    background: white;
    width: 100%;
    height: 100%;
    /* margin-left:250px ; */
       transition: all 0.8s;
}
#btnMenuSideBar{
    width: 4%;
    padding: 10px;
}
.menu-bar{
    z-index: 1;
    cursor: pointer;
    position: absolute;
 }
 
 .openMenu{
    transform: translateX(250px);
 }

 .v-enter-active, .v-leave-active{
transition: opacity 0.2s;
 }

 .v-enter, .v-leave-to{
     opacity: 0;
 }
</style>