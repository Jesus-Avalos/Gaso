<template>
    <table class="table table-bordered">
        <thead class="bg-dark">
            <tr>
                <th>Mesa</th>
                <th>Descripción</th>
                <th><i class="fas fa-wrench"></i></th>
            </tr>
        </thead>
        <tbody>
            <Fila v-for="(item, index) in lista" 
                :key="item.id" 
                :index="index" 
                :item="item"
                @updateMesa="updateMesa"
                @deleteMesa="deleteMesa"></Fila>
        </tbody>
    </table>
</template>

<script>
import Fila from './Fila'
export default {
    props: ['mesas'],
    data(){
        return {
            lista: JSON.parse(this.mesas)
        }
    },
    methods: {
        updateMesa(params){
            this.lista[params.index].name = params.name;
            this.lista[params.index].description = params.description;
        },
        deleteMesa(index){
            this.lista.splice(index,1);
        }
    },
    components: {
        Fila
    }
}
</script>

<style>

</style>