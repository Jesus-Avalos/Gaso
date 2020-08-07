<template>
    <div class="col-12 col-md-6 mt-3">
        <div align="center">
            <h2>Abonos del turno</h2>
        </div>
        <table class="table table-bordered comprasTable dt-responsive">
            <thead class="bg-dark">
                <tr>
                    <th>Folio</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <Abono 
                    v-for="(abono,index) in abonos" 
                    :key="abono.id" 
                    :index="index" 
                    :abono="abono"
                    @updateDate="updateDate" />
            </tbody>
        </table>
    </div>
</template>

<script>
import Abono from './Abono'
export default {
    data () {
        return {
            abonos: []
        }
    },
    beforeMount () {
        this.getAbonos();
    },
    methods: {
        initDT () {
            $(function(){
                $('.abonosTable').DataTable({
                    "order": [[ 0, "desc" ]],
                    "autoWidth" : false,
                    "info"      : false,
                    "searching" : false,
					"lengthChange": false
                });
            })
        },
        getAbonos (){
            axios.get('/cortes/getAbonosCortes').then((response) => {
                this.abonos = response.data;
                this.initDT();
            })
        },
        updateDate(params){
            this.abonos[params.index].created_at = params.date;
        }
    },
    components : {
        Abono
    }
}
</script>

<style>

</style>