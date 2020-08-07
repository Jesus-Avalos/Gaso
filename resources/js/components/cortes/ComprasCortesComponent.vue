<template>
    <div class="col-12 col-md-6">
        <div align="center">
            <h2>Compras del turno</h2>
        </div>
        <table class="table table-bordered comprasTable dt-responsive">
            <thead class="bg-dark">
                <tr>
                    <th>Folio</th>
                    <th>Fecha</th>
                    <th>Proovedor</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <Compra 
                    v-for="(compra,index) in compras" 
                    :key="compra.id" 
                    :index="index" 
                    :compra="compra"
                    @updateDate="updateDate" />
            </tbody>
        </table>
    </div>
</template>

<script>
import Compra from './Compra'
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
                    "order": [[ 0, "desc" ]],
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
        },
        updateDate(params){
            this.compras[params.index].created_at = params.date;
        }
    },
    components : {
        Compra
    }
}
</script>

<style>

</style>