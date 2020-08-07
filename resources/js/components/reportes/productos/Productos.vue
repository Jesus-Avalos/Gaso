<template>
    <div class="row">
        <div class="col-12 col-md-7">
            <Fecha
                @fechas="getProductos"
                :tipo="'productos'"/>
        </div>
        <div class="col-12 col-md-5">
            <Table :datos="datos" />
        </div>
	</div>
</template>

<script>
import Fecha from '../FechasComponent'
import Table from './Table'
export default {
    data() {
        return {
            datos : []
        }
    },
    methods: {
        getProductos(fechas){
            axios.post('/reportes/getProductos', fechas).then((response) => {
                this.datos = response.data;
				$('.generalTable').DataTable().destroy();
                this.initDT();
			})
        },
        initDT () {
			$(function(){
				$('.generalTable').DataTable({
                    "order": [[ 1, "desc" ]],
					"paging"    : false,
					"autoWidth" : false,
					"info"      : false,
					"searching" : false,
					"pageLength" : -1
				});
			})
		}
    },
    components : {
        Fecha,
        Table
    }
}
</script>

<style>

</style>