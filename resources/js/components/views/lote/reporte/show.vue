<template>
    <div class="container">
        <div class="row">
            <div class="col-10 mt-3 mx-auto">
                <h2>Detalles Lote</h2>
                <div class="card shadow rounded">
                    <div class="card-header">
                        <span class="font-weight-bold">Código:</span> <span class="text-success font-weight-bold border rounded p-1 shadow">{{this.$route.params.lote.code}}</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 pr-0">
                                <span class="font-weight-bold">Cantidad Aves:</span>
                            </div>
                            <div class="col-2 px-0">
                                <span>{{this.$route.params.lote.quantity}}</span>
                            </div>
                            <div class="col-1 px-0">
                                <span class="font-weight-bold">Estado:</span>
                            </div> 
                            <div class="col-1 px-0">
                                <span data-html="true" data-toggle="tooltip" data-placement="top" title="<div class='text-left'>
                                    <span>W: Esperando</span><br>
                                    <span>A: Activo</span><br>
                                    <span>F: Terminado</span>
                                </div>" class="p-2 border border-dark rounded-pill shadow font-weight-bold @if($lote->state == 'F') text-success  @else text-danger  @endif">{{this.$route.params.lote.state}}</span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div>
                                    <table id="tableSho" data-show-footer="true" class="table table-sm table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th   data-field="date" data-footer-formatter="totalC" data-align="center">Fecha</th>
                                                <th  data-field="comida" data-align="center"  data-footer-formatter="totalComida" >Consumo Día.</th>
                                                <th  data-align="center" data-field="acumulado" >Acumulado</th>
                                                <th  data-align="center" data-field="muertes" data-footer-formatter="totalMuertes">Muertes Diaria</th>
                                                <th  data-align="center" data-field="acumuladomuertes" >Acumulado</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
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
        reports:''
    }
},
mounted() {
    this.getLoteInfo();
    $('#tableSho').bootstrapTable();
},
methods: {
    getLoteInfo(){
        axios.get('/reportesLote',{
            params:{
                lote:this.$route.params.lote.id
            }
        }).then(({data})=>{
            this.reports = data;
            let cont=0 ;
            let cont2=0 ;
            data.map(function(row,index){
                
                cont += row.feed;
                cont2 += row.deaths;

                $('#tableSho').bootstrapTable('insertRow',{
                    index: $('#tableSho').bootstrapTable('getOptions').totalRows+1,
                    row:{
                        comida:row.feed,
                        date:row.date,
                        muertes:row.deaths,
                        acumulado:cont,
                        acumuladomuertes:cont2
                    }
                });
            });
            
        }).catch(error=>{
            console.log(error)
        });
    }
},
}
</script>

<style>

</style>