<template>
    <div>
        <div class="alert alert-success" style="display:none">
            Registrado correctamente
        </div>
        <header-compras :proovs="proovs" :ings="ings" @new="agregaNew"></header-compras>
        <body-compras :lista="lista" @delete="deleteRow"></body-compras>
        <footer-compras :total="total"></footer-compras>
    </div>
</template>

<script>
import Vuex from 'vuex';
export default {

    props: ['proovedores','inventario'],
    data(){
        return {
            proovs : JSON.parse(this.proovedores),
            ings : JSON.parse(this.inventario),
            lista : []
        }
    },
    methods : {
        agregaNew(datos){
            this.lista.push(datos);
        },
        deleteRow(ind){
            this.lista.splice(this.lista.indexOf(ind),1);
        }
    },
    computed: {
        ...Vuex.mapState(['total'])
    }
}
</script>

<style>

</style>