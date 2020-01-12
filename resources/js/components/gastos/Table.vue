<template>
    <div>
        <div class="table-responsive">
            <table class="table table-bordered gastoTable">
                <thead class="bg-dark">
                    <tr>
                        <th>Usuario</th>
                        <th>Monto</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th><i class="fas fa-wrench"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <FilaGastos v-for="(item,index) in lista" 
                        :key="item.id" 
                        :index="index" 
                        :item="item"
                        @updateItem="updateItem"
                        @deleteItem="deleteItem"></FilaGastos>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import FilaGastos from './Fila.vue';
export default {
    name: 'TableGastos',
    props: ['lista'],
    methods: {
        updateItem(params){
            this.$emit('updateItem',params);
        },
        deleteItem(index){
            this.$emit('deleteItem',index);
        }
    },
    components: {
        FilaGastos
    }
}
</script>

<style>

</style>