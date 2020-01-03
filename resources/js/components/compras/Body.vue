<template>
    <table class="table table-bordered mt-2">
        <thead class="bg-dark">
            <tr>
                <th>Artículo</th>
                <th>Cantidad</th>
                <th>Precio unidad</th>
                <th>Total</th>
                <th><i class="fas fa-wrench"></i></th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="lista.length < 1"><td colspan="5"><h3>Agrega artículos</h3></td></tr>
            <fila-compras v-for="(item,index) in lista" :key="item.id" :ingId="item" :ind="index" @delete="deleteRow" v-else></fila-compras>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ['lista'],
    methods: {
        deleteRow(ind){
            this.$emit('delete',ind);
        }
    }
}
</script>

<style>

</style>