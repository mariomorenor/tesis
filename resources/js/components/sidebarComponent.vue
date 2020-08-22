<template>
  <div class="sidebar">
      <h2>Menú</h2>
      <ul>
          <li><router-link :to="{name:'control_lote_index'}">Control</router-link></li>
          <li><router-link :to="{name:'reporte_lote_index'}">Reportes</router-link></li>
          <li><router-link :to="{name:'user_index'}">Usuarios</router-link></li>
          <!-- <li><router-link :to="{name:'support'}">Soporte</router-link></li> -->
      </ul>
  </div>
</template>

<script>
export default {

}
</script>

<style>

    /* SIDEBAR COMPONENT LIVEWIRE */
    
    .sidebar {
        position: absolute;
        width: 250px;
        height: 100%;
        background: #333;
        color: #fff;
        outline: 1px solid #2a2a2a;
    }

    .sidebar ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .sidebar a {
        color: #fff;
        text-decoration: none;
        padding: 10px;
        display: block;
    }

    .sidebar h2 {
        text-align: center;
        margin-top: 20%;
        padding: 10px;
        margin-bottom: 1px;
        background: #2a2a2a;
    }

    .sidebar li {
        outline: 1px solid #2a2a2a;
        transition: all 0.1s;

    }

    .sidebar li:hover {
        background: #444;
        border-left: 5px solid #eee;
    }

</style>