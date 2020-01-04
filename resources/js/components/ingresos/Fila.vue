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
            <button class="btn btn-sm btn-secondary" @click="editMode = false" v-if="editMode"><i class="fas fa-ban"></i></button>
            <button class="btn btn-sm btn-danger" @click="deleteModal = true" data-toggle="modal" :data-target="'#deleteModal'+item.id"><i class="fas fa-trash"></i></button>
        </td>
        <ModalIngresos @deleteItem="deleteItem" :item="item"></ModalIngresos>
    </tr>
</template>

<script>
import ModalIngresos from './Modal.vue';
export default {
    name: 'FilaIngresos',
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
            const dataparams = {
                index: this.index,
                monto: this.monto,
                descripcion: this.descripcion
            };
            await axios.put('ingreso/'+this.item.id, dataparams).then(response => {
                $('.alert').html('Actualizado con éxito');
                $('.alert').fadeToggle(2000);
                $('.alert').fadeToggle(2000);
                const params = {
                    index: this.index,
                    monto: this.monto,
                    descripcion: this.descripcion,
                    data: response.data
                };
                this.$emit('updateItem',params);
            });
            this.editMode = false;
        },
        async deleteItem(){
            await axios.delete('ingreso/'+this.item.id).then(response => {
                $('.alert').html('Eliminado con éxito');
                $('.alert').fadeToggle(2000);
                $('.alert').fadeToggle(2000);
                const params = {
                    index: this.index,
                    data: response.data
                }
                this.$emit('deleteItem',params);
            });
        }
    },
    components: {
        ModalIngresos
    }
}
</script>

<style>

</style>