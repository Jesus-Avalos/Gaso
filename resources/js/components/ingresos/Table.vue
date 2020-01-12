<template>
    <div>
        <div class="table-responsive">
            <table class="table table-bordered ingresoTable">
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
                    <FilaIngresos v-for="(item,index) in lista" 
                        :key="item.id" 
                        :index="index" 
                        :item="item"
                        @updateItem="updateItem"
                        @deleteItem="deleteItem"></FilaIngresos>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import FilaIngresos from './Fila.vue';
export default {
    name: 'TableIngresos',
    props: ['lista'],
    methods: {
        updateItem(params){
            this.$emit('updateItem',params);
        },
        deleteItem(params){
            this.$emit('deleteItem',params);
        }
    },
    components: {
        FilaIngresos
    }
}
</script>

<style>

</style>