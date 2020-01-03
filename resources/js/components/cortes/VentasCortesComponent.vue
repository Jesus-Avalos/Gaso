<template>
    <div class="col-12 col-md-6">
        <div align="center">
            <h2>Ventas del turno</h2>
        </div>
        <table class="table table-bordered emptyTable dt-responsive">
            <thead class="bg-dark">
                <tr>
                    <th>Folio</th>
                    <th>Tipo operación</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="venta in ventas" :key="venta.id">
                    <td>{{ venta.id }}</td>
                    <td>{{ venta.tipo }}</td>
                    <td>{{ venta.status }}</td>
                    <td>{{ venta.total }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
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
        }
    }

}
</script>

<style>

</style>