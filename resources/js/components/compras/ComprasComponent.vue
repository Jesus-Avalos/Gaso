<template>
    <div>
        <div class="alert alert-success" style="display:none">
            Registrado correctamente
        </div>
        <header-compras :proovs="proovs" :ings="ings" @addNew="agregaNew"></header-compras>
        <body-compras :lista="lista" @delete="deleteRow"></body-compras>
        <footer-compras :total="subtotal"></footer-compras>
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
            lista : [],
            existentes : []
        }
    },
    methods : {
        agregaNew(id){
            if(this.existentes.indexOf(id) == -1){
                this.existentes.push(id);
                axios.get('/compra/getIng/'+id).then(response => {
                    const datos = response.data;
                    this.lista.push(datos[0]);
                });
            }else{
                alert('El ingrediente ya fue añadido');
            }
        },
        deleteRow(ind){
            this.lista.splice(ind,1);
            this.existentes.splice(ind,1);
        }
    },
    computed: {
        ...Vuex.mapState(['subtotal'])
    }
}
</script>

<style>

</style>