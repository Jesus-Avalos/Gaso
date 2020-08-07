<template>
    <table class="table table-bordered dt-responsive" id="generalTable">
		<thead class="thead-dark">
			<tr>
				<th><i class="fa fa-wrench"></i></th>
				<th>Folio</th>
				<th>Tipo</th>
				<th>Total</th>
				<th>Fecha venta</th>
				<th>Estado</th>
			</tr>
		</thead>
        <tbody>
            <venta-component 
				v-for="dato in datos" 
				:key="dato.id"
                :dato = 'dato'
				:tipo='tipo'>
			</venta-component>
        </tbody>
	</table>
</template>

<script>
export default {
    props: ['datos','tipo']

}
</script>

<style>

</style>