<template>
    <tr>
        <td>{{ abono.id }}</td>
        <td>
            <span v-if="!editDate">{{ abono.created_at }}</span>
            <input type="date" v-model="fecha" v-else>
            <button class="btn btn-sm btn-secondary" v-if="!editDate" @click="editDate = !editDate"><i class="fas fa-edit"></i></button>
            <button class="btn btn-sm btn-success" v-else @click="updateDate"><i class="fas fa-check"></i></button>
        </td>
        <td>{{ abono.nombre }}</td>
        <td>{{ abono.total_pago }}</td>
    </tr>
</template>

<script>
export default {
    name: 'Abono',
    props : ['abono','index'],
    data(){
        return {
            fecha : this.abono.created_at,
            editDate : false
        }
    },
    methods : {
        async updateDate(){
            const params = {
                index : this.index,
                date : this.fecha,
                tipo : 'abonos'
            }
            this.editDate = !this.editDate;
            await axios.put('/cortes/updateDate/'+this.abono.id,params).then(response => {
                this.$emit('updateDate',params)
            });
        }
    }
}
</script>

<style>

</style>