<template>
    <div class="table-responsive">
        <table class="table table-bordered mt-2">
            <thead class="bg-dark">
                <tr>
                    <th><i class="fas fa-wrench"></i></th>
                    <th>Artículo</th>
                    <th>Unidad</th>
                    <th>Cantidad</th>
                    <th>Precio unidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <Detail :detail="detail" />
                <tr v-if="lista.length < 1"><td colspan="6"><h3>Agrega artículos</h3></td></tr>
                <fila-compras v-for="(item,index) in lista" :key="item.id" :ingId="item" :ind="index" @delete="deleteRow" @detailUp="detailUp" v-else />
            </tbody>
        </table>
    </div>
</template>

<script>
import Detail from './ModalDetail.vue'
export default {
    props: ['lista'],
    data(){
        return {
            detail : {
                nombre : '',
                tipo : '',
                unidad : '',
                cantidad : '',
                por_unidad : '',
                porciones : '',
                precio_unidad : '',
                precio_porcion : '',
                stock_minimo : ''
            }
        }
    },
    methods: {
        deleteRow(ind){
            this.$emit('delete',ind);
        },
        detailUp(params){
            this.detail = params;
        }
    },
    components : {
        Detail
    }
}
</script>

<style>

</style>