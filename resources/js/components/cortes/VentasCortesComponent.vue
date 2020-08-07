<template>
    <div class="col-12 col-md-6">
        <div align="center">
            <h2>Ventas del turno</h2>
        </div>
        <table class="table table-bordered emptyTable dt-responsive">
            <thead class="bg-dark">
                <tr>
                    <th>Folio</th>
                    <th>Fecha</th>
                    <th>Tipo operación</th>
                    <th>Tipo pago</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <Venta 
                    v-for="(venta,index) in ventas" 
                    :key="venta.id" 
                    :index="index" 
                    :venta="venta"
                    @updateDate="updateDate" />
            </tbody>
        </table>
    </div>
</template>

<script>
import Venta from './Venta.vue'
export default {
    data () {
        return {
            ventas: []
        }
    },
    mounted () {
        this.getVentas();
    },
    methods: {
        initDT () {
            $(function(){
                    $('.emptyTable').DataTable({
                    "order": [[ 0, "desc" ]],
                    "autoWidth" : false,
                    "info"      : false,
                    "searching" : false,
					"lengthChange": false
                });
            })
        },
        getVentas (){
            axios.get('/cortes/getVentasCortes').then((response) => {
                this.ventas = response.data;
                this.initDT();
            })
        },
        updateDate(params){
            this.ventas[params.index].created_at = params.date;
        }
    },
    components : {
        Venta
    }

}
</script>

<style>

</style>