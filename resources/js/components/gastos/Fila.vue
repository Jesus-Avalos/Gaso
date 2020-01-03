<template>
    <tr>
        <td>{{ item.name }}</td>
        <td>
            <p v-if="!editMode">{{ item.monto }}</p>
            <input v-model="monto" type="number" step="any" min="0" required v-else>
        </td>
        <td>
            <p v-if="!editMode">{{ item.descripcion }}</p>
            <textarea v-model="descripcion" rows="3" class="form-control" required v-else></textarea>
        </td>
        <td>{{ item.fecha }}</td>
        <td>
            <button class="btn btn-sm btn-info" v-if="!editMode" @click="editMode = !editMode"><i class="fas fa-edit"></i></button>
            <button class="btn btn-sm btn-success" @click="update" v-else><i class="fas fa-check-circle"></i></button>
            <button class="btn btn-sm btn-danger" @click="deleteModal = true" data-toggle="modal" :data-target="'#deleteModal'+item.id"><i class="fas fa-trash"></i></button>
        </td>
        <ModalGastos @deleteItem="deleteItem" :item="item"></ModalGastos>
    </tr>
</template>

<script>
import ModalGastos from './Modal.vue';
export default {
    name: 'FilaGastos',
    props: ['item','index'],
    data(){
        return {
            editMode: false,
            monto: this.item.monto,
            descripcion: this.item.descripcion
        }
    },
    methods: {
        async update(){
            const params = {
                index: this.index,
                monto: this.monto,
                descripcion: this.descripcion
            };
            await axios.put('gasto/'+this.item.id, params).then(response => {
                $('.alert').html('Actualizado con éxito');
                $('.alert').fadeToggle(2000);
                $('.alert').fadeToggle(2000);
                this.$emit('updateItem',params);
            });
            this.editMode = false;
        },
        async deleteItem(){
            await axios.delete('gasto/'+this.item.id).then(response => {
                $('.alert').html('Eliminado con éxito');
                $('.alert').fadeToggle(2000);
                $('.alert').fadeToggle(2000);
            });
            this.$emit('deleteItem',this.index);
        }
    },
    components: {
        ModalGastos
    }
}
</script>

<style>

</style>