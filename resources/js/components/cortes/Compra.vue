<template>
    <tr>
        <td>{{ compra.id }}</td>
        <td>
            <span v-if="!editDate">{{ compra.created_at }}</span>
            <input type="date" v-model="fecha" v-else>
            <button class="btn btn-sm btn-secondary" v-if="!editDate" @click="editDate = !editDate"><i class="fas fa-edit"></i></button>
            <button class="btn btn-sm btn-success" v-else @click="updateDate"><i class="fas fa-check"></i></button>
        </td>
        <td>{{ compra.nombre }}</td>
        <td>{{ compra.status }}</td>
        <td>{{ compra.total }}</td>
    </tr>
</template>

<script>
export default {
    name: 'Compra',
    props : ['compra','index'],
    data(){
        return {
            fecha : this.compra.created_at,
            editDate : false
        }
    },
    methods : {
        async updateDate(){
            const params = {
                index : this.index,
                date : this.fecha,
                tipo : 'compras'
            }
            this.editDate = !this.editDate;
            await axios.put('/cortes/updateDate/'+this.compra.id,params).then(response => {
                this.$emit('updateDate',params)
            });
        }
    }
}
</script>

<style>

</style>