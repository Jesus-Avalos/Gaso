<template>
    <div class="">
        <div class="row text-center mb-2">
            <div class="col bg-success"><strong>Ingresos: {{ datos.ingresos }}</strong></div>
            <div class="col bg-danger"><strong>Egresos: {{ datos.egresos }}</strong></div>
            <div class="col bg-primary"><strong>Caja extra: {{ datos.caja_extra }}</strong></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 ">
                <FormGastos @addNew="addNew" :maximo="datos.caja_extra" v-if="datos.caja_extra > 0"></FormGastos>
                <div class="alert alert-warning text-center" v-else><h3>Caja extra en 0</h3></div>
            </div>
            <div class="col-12 col-md-6">
                <TableGastos :lista="lista" @updateItem="updateItem" @deleteItem="deleteItem"></TableGastos>
            </div>
        </div>
    </div>
</template>

<script>
    import FormGastos from './Form.vue';
    import TableGastos from './Table.vue';
    export default {
        props: ['gastos','empresa'],
        data(){
            return {
                lista : [],
                datos : JSON.parse(this.empresa)
            }
        },
        methods: {
            addNew(params){
                this.lista.push({
                    id : params[1].id,
                    name: params[0],
                    monto: params[1].monto,
                    descripcion : params[1].descripcion,
                    fecha : params[1].created_at
                });
                this.datos.caja_extra = params[2].caja_extra;
                this.datos.egresos = params[2].egresos;
                $('.gastoTable').DataTable().destroy();
                this.initDT();
            },
            updateItem(params){
                this.lista[params.index].monto = params.monto;
                this.lista[params.index].descripcion = params.descripcion;
            },
            deleteItem(index){
                this.lista.splice(index,1);
                $('.gastoTable').DataTable().destroy();
                this.initDT();
            },
            initDT(){
                $(function(){
                    $('.gastoTable').DataTable({
                        "order": [[ 3, "desc" ]],
                        "autoWidth" : false,
                        "paging" : false,
                        "bInfo" : false,
                        "pageLength": -1
                    });
                });
            }
        },
        beforeMount(){
            var datos = JSON.parse(this.gastos);
            datos.forEach(element => {
                this.lista.push({
                    id: element.id,
                    monto: element.monto,
                    descripcion : element.descripcion,
                    name: element.name,
                    fecha : element.created_at
                });
            });
        },
        mounted(){
            this.initDT();
        },
        components: {
            TableGastos,
            FormGastos
        }
    }
</script>