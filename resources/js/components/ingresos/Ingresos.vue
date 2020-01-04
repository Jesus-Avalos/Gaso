<template>
    <div class="">
        <div class="row text-center mb-2">
            <div class="col bg-success"><strong>Ingresos: {{ datos.ingresos }}</strong></div>
            <div class="col bg-danger"><strong>Egresos: {{ datos.egresos }}</strong></div>
            <div class="col bg-primary"><strong>Caja extra: {{ datos.caja_extra }}</strong></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 ">
                <FormIngresos @addNew="addNew" v-if="datos.caja_extra > 0"></FormIngresos>
                <div class="alert alert-warning text-center" v-else><h3>Caja extra en 0</h3></div>
            </div>
            <div class="col-12 col-md-6">
                <TableIngresos :lista="lista" @updateItem="updateItem" @deleteItem="deleteItem"></TableIngresos>
            </div>
        </div>
    </div>
</template>

<script>
    import FormIngresos from './Form.vue';
    import TableIngresos from './Table.vue';
    export default {
        props: ['ingresos','empresa'],
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
                this.datos.ingresos = params[2].ingresos;
                $('.ingresoTable').DataTable().destroy();
                this.initDT();
            },
            updateItem(params){
                this.lista[params.index].monto = params.monto;
                this.lista[params.index].descripcion = params.descripcion;
                this.datos.caja_extra = params.data.caja_extra;
                this.datos.ingresos = params.data.ingresos;
            },
            deleteItem(params){
                this.lista.splice(params.index,1);
                this.datos.caja_extra = params.data.caja_extra;
                this.datos.ingresos = params.data.ingresos;
                $('.ingresoTable').DataTable().destroy();
                this.initDT();
            },
            initDT(){
                $(function(){
                    $('.ingresoTable').DataTable({
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
            var datos = JSON.parse(this.ingresos);
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
            TableIngresos,
            FormIngresos
        }
    }
</script>