<template>
    <div>
		<fecha-component
			@fechas="getVentas"
			:total="total"
			:numVentas="numVentas"></fecha-component>
		<reporte-table-component :datos = 'datos' :tipo="tipo"></reporte-table-component>
	</div>
</template>

<script>
export default {
	props: ['tipo'],
	data () {
		return {
			datos : [],
			total : 0,
			numVentas : 0
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
				this.numVentas = response.data.length;
				this.total = this.calculaTotal(response.data);
				$('#generalTable').DataTable().destroy();
                this.initDT();
			})
		},
		initDT () {
			$(function(){
				$('#generalTable').DataTable({
                    "order": [[ 4, "desc" ]],
					"paging"    : false,
					"autoWidth" : false,
					"info"      : false,
					"searching" : false,
					"pageLength" : -1
				});
			})
		},
		calculaTotal(data){
			var total = 0;
			data.forEach(element => {
				total += element.total
			});
			return total;
		}
	}
}
</script>

<style>

</style>