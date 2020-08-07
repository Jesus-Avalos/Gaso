<template>
    <tr>
        <td>{{ venta.id }}</td>
        <td>
            <span v-if="!editDate">{{ venta.created_at }}</span>
            <input type="date" v-model="fecha" v-else>
            <button class="btn btn-sm btn-secondary" v-if="!editDate" @click="editDate = !editDate"><i class="fas fa-edit"></i></button>
            <button class="btn btn-sm btn-success" v-else @click="updateDate"><i class="fas fa-check"></i></button>
        </td>
        <td>{{ venta.tipo }}</td>
        <td>{{ venta.tipoPago }}</td>
        <td>{{ venta.status }}</td>
        <td>{{ venta.total }}</td>
    </tr>
</template>

<script>
export default {
    name: 'Venta',
    props : ['venta','index'],
    data(){
        return {
            fecha : this.venta.created_at,
            editDate : false
        }
    },
    methods : {
        async updateDate(){
            const params = {
                index : this.index,
                date : this.fecha,
                tipo : 'ventas'
            }
            this.editDate = !this.editDate;
            await axios.put('/cortes/updateDate/'+this.venta.id,params).then(response => {
                this.$emit('updateDate',params)
            });
        }
    }
}
</script>

<style>

</style>