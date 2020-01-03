<template>
    <div>
		<fecha-component
			@fechas="getVentas"></fecha-component>
		<reporte-table-component :datos = 'datos' :tipo="tipo"></reporte-table-component>
	</div>
</template>

<script>
export default {
	props: ['tipo'],
	data () {
		return {
			datos : []
		}
	},
    mounted () {
        this.initDT();
	},
	methods: {
		getVentas(fechas) {
			var tipo = (this.tipo == 'compra') ? 'Shops' : 'Sales';
			axios.post('/reportes/get'+tipo, fechas).then((response) => {
				this.datos = response.data;
				$('#generalTable').DataTable().destroy();
                this.initDT();
			})
		},
		initDT () {
			$(function(){
				$('#generalTable').DataTable({
                    "order": [[ 3, "desc" ]],
					"paging"    : false,
					"autoWidth" : false,
					"info"      : false,
					"searching" : false,
					"pageLength" : -1
				});
			})
		},
	}
}
</script>

<style>

</style>