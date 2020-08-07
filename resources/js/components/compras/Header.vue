<template>
    <div class="row ">
        <div class="form-group col-12">
            <label for="" class="w-100">Proovedor</label>
            <select name="proovedor_id" class="form-control w-50 selectpicker" data-live-search="true" data-size="4" required>
                <option v-for="(item, index) in proovedores" :key="index" :value="item.id">{{ item.nombre }}</option>
            </select>
            <createProovedor @addProovedor="addProovedor"></createProovedor>
            <button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target=".createProovedor"><i class="fas fa-plus"></i></button>
        </div>
        <div class="form-group col-12">
            <label for="" class="w-100">Artículos</label>
            <select id="ing_id" class="form-control selectpicker w-50" data-live-search="true" data-size="4" required>
                <option v-for="(item,index) in articulos" :key="index" :value="item.id">{{ item.nombre }}</option>
            </select>
            <createArticulo @addArticulo="addArticulo"></createArticulo>
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target=".createArticulo"><i class="fas fa-plus"></i></button>
        </div>
        <div class="form-group col-12">
            <button type="button" class="btn btn-info float-right" @click="agregarIng">Agregar</button>
        </div>
    </div>
</template>

<script>
import createArticulo from './CreateArticulo.vue';
import createProovedor from './CreateProovedor.vue';
export default {
    props: ['proovs','ings'],
    data(){
        return {
            existentes : [],
            proovedores: [],
            articulos: []
        }
    },
    methods : {
        agregarIng(){
            var id = $('#ing_id').val();
            if(id != 0){
                this.$emit('addNew',id);
            }else{
                alert('Selecciona un artículo');
            }
        },
        getArticulos(){
            axios.get('/getArticulos').then(response => {
                var datos = response.data;
                datos.forEach(element => {
                    this.articulos.push(element);
                });
            });
        },
        getProovedores(){
            axios.get('/getProovedores').then(response => {
                var datos = response.data;
                datos.forEach(element => {
                    this.proovedores.push(element);
                });
            });
        },
        addArticulo(){
            this.articulos = [];
            this.getArticulos();
            $('.createArticulo').modal('hide');
            $('.alert').fadeToggle(2000);
            $('.alert').fadeToggle(2000);
        },
        addProovedor(){
            this.proovedores = [];
            this.getProovedores();
            $('.createProovedor').modal('hide');
            $('.alert').fadeToggle(2000);
            $('.alert').fadeToggle(2000);
        }
    },
    components: {
        createArticulo,
        createProovedor
    },
    updated(){
        $('.selectpicker').selectpicker('refresh');
    },
    beforeMount(){
        this.getArticulos();
        this.getProovedores();
    }
}
</script>

<style>

</style>