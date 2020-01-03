<template>
    <tr class="trPadding">
        <td>
            <span v-if="!editMode">{{ item.name }}</span>
            <input v-else type="text" v-model="mesa.name" class="form-control">
        </td>
        <td>
            <span v-if="!editMode">{{ item.description }}</span>
            <textarea v-else rows="2" v-model="mesa.description" class="form-control"></textarea>
        </td>
        <td>
            <button v-if="editMode" class="btn btn-success btn-sm" @click="updateMesa(item.id)"><i class="fas fa-check-circle"></i></button>
            <button v-if="editMode" class="btn btn-secondary btn-sm" @click="editMode = false"><i class="fas fa-ban"></i></button>
            <button v-else class="btn btn-info btn-sm" @click="editMode = true"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger btn-sm" @click="deleteMesa(item.id)"><i class="fas fa-trash"></i></button>
        </td>
    </tr>
</template>

<script>
export default {
    name: 'Fila',
    props: ['item','index'],
    data(){
        return {
            editMode: false,
            mesa : {
                id: this.item.id,
                name: this.item.name,
                description: this.item.description
            }
        }
    },
    methods: {
        async updateMesa(id){
            const params = {
                name: this.mesa.name,
                description: this.mesa.description,
                index: this.index
            };
            await axios.put('/mesas/'+id,params).then(response => {
                $('.alert').html(response.data);
                $('.alert').fadeToggle(2000);
                $('.alert').fadeToggle(2000);
            });
            this.$emit('updateMesa',params);
            this.editMode = false;
        },
        async deleteMesa(id){
            var cf = confirm('Confirmar eliminación de mesa..');
            if(cf){
                await axios.delete('/mesas/'+id).then(response => {
                    $('.alert').html(response.data);
                    $('.alert').fadeToggle(2000);
                    $('.alert').fadeToggle(2000);
                });
                this.$emit('deleteMesa',this.index);
            }
        }
    }
}
</script>

<style>
    .trPadding > td{
        padding: 0%;
        padding-top: 5px;
        padding-bottom: 5px;
    }
</style>