<template>
    <div class="col-12 col-md-6">
        <div align="center">
            <h2>Compras del turno</h2>
        </div>
        <table class="table table-bordered comprasTable dt-responsive">
            <thead class="bg-dark">
                <tr>
                    <th>Folio</th>
                    <th>Proovedor</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="compra in compras" :key="compra.id">
                    <td>{{ compra.id }}</td>
                    <td>{{ compra.nombre }}</td>
                    <td>{{ compra.status }}</td>
                    <td>{{ compra.total }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data () {
        return {
            compras: []
        }
    },
    mounted () {
        this.getCompras();
    },
    methods: {
        initDT () {
            $(function(){
                $('.comprasTable').DataTable({
                    "order": [[ 0, "asc" ]],
                    "autoWidth" : false,
                    "info"      : false,
                    "searching" : false,
					"lengthChange": false
                });
            })
        },
        getCompras (){
            axios.get('/cortes/getComprasCortes').then((response) => {
                this.compras = response.data;
                this.initDT();
            })
        }
    }

}
</script>

<style>

</style>