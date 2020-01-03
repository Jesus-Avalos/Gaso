<template>
    <div class="row justify-content-center" style="margin-top: 2%; margin-bottom: 1%;">
		<form v-on:submit.prevent="SendFechas" class="col-12">
			<div class="row">
				<div class="col-6 col-md-4">
					<input type="date" class="form-control" v-model="fecha1" required>
				</div>
				<div class="col-6 col-md-4">
					<input type="date" class="form-control" v-model="fecha2" required>
				</div>
				<div class="col-12 col-md-4" align="center">
					<button class="btn btn-primary">Buscar</button>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
export default {
    data () {
        return {
			fecha1 : '',
			fecha2 : ''
        }
	},
	methods: {
		SendFechas() {
			
			let fechas = {
				fecha1 : this.fecha1,
				fecha2 : this.fecha2
			}
			this.$emit('fechas',fechas);
		}
	}
}
</script>

<style>

</style>