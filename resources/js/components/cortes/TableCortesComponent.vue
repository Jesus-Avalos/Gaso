<template>
    <div>
        <table class="table table-bordered generalTable dt-responsive" >
            <thead class="bg-dark">
                <tr>
                    <th><i class="fa fa-wrench"></i></th>
                    <th>Fecha</th>
                    <th>Apertura</th>
                    <th>Recuento</th>
                    <th>Caja</th>
                    <th>Descuadre</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="corte in cortes" :key="corte.id">
                    <td><a :href="'/cortes/show/' + corte.id" class="btn btn-primary btn-sm"><i class="fa fa-bars"></i></a></td>
                    <td>{{ corte.created_at }}</td>
                    <td>{{ corte.apertura }}</td>
                    <td>{{ corte.recuento }}</td>
                    <td>{{ corte.caja }}</td>
                    <td :class="(corte.descuadre < 0) ? 'text-danger' : 'text-success'">{{ corte.descuadre }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data () {
        return {
            cortes: []
        }
    },
    mounted () {
        this.getCortes();
    },
    methods: {
        initDT () {
            $(function(){
                $('.generalTable').DataTable({
                    "order": [[ 1, "desc" ]],
                    "autoWidth" : false,
                    "paging" : false,
                    "bInfo" : false,
                    "pageLength": -1
                });
            })
        },
        getCortes (){
            axios.get('/cortes/getCortes').then((response) => {
                this.cortes = response.data;
                this.initDT();
            })
        }
    }

}
</script>

<style>

</style>