<template>
    <table class="table table-bordered dt-responsive generalTable">
        <thead class="bg-dark">
            <tr>
                <th>Nombre</th>
                <th>Ventas</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item,index) in datos" :key="index">
                <td>{{ item.name }}</td>
                <td>{{ item.ventasNum }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props : ['datos']
}
</script>

<style>

</style>