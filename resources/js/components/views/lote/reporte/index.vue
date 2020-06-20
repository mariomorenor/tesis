<template>
      <div class="container">
        <div class="row">
            <div class="col-9 mx-auto">
                <div class="">
                    <table class="table table-hover" id="table">
                        <thead>
                            <tr>
                                <th data-field="code">Código</th>
                                <th data-field="date_in">Fecha Ingreso</th>
                                <th data-field="date_out" data-formatter="date_outFormatter">Fecha Salida</th>
                                <th data-field="operate" data-align="center" data-formatter="operateForm" data-events="operateEvents"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

window.operateEvents = {
    
    'click .btnInfoLote': function(e, value, row){
            app.__vue__.$router.push({name:'reporte_lote_show',params:{lote:row}
            });
    }
}

export default {
    mounted() {
        this.initTableLotes();
    },
methods: {
    initTableLotes(){
        let $table = $('#table');

        $table.bootstrapTable({
        url:'/getLotes',
        height: '500',
        search: true,
    });
    }
},
}
</script>

<style>

</style>