<template>
 
    <div class="container ">
        <div class="row mt-3">
            <div class="col-8 mx-auto" >
                <div>
                    <div id="toolbar">
                        <router-link :to="{name: 'user_create'}" class="btn btn-primary">Agregar</router-link>
                    </div>
                    <table id="usersTable" data-url="/getUsers" class="table table-hover table-stripped">
                        <thead>
                            <tr>
                            <th data-field="name">Nombres</th>
                            <th data-field="username">Usuario</th>
                            <th data-field="roles_u"  data-formatter="rolesFormatter" >Rol</th>
                            <th data-field="operate" data-width="100" data-formatter="operateFormatterUser" data-events="operateEventsUser">Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

window.operateEventsUser = {
    'click .editUserTable': function (e, value, row) {
            app.__vue__.$router.push({name: 'user_edit', params:{user:row}});
      }
}

export default {
mounted() {
 

    this.getUsers();
    
},
methods: {
    getUsers(){
           let $table = $('#usersTable');

    $table.bootstrapTable({
        responseHandler: function (res) {
            // console.log(res)
            return res
        },
        url: 'getusers',
        locale: 'es_ES',
        height:'500',
        toolbar:'#toolbar'
    });
    }
},
}
</script>

<style>

</style>