<template>
    <div class="modal fade productosModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h2 class="modal-title">Productos</h2>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <h3 class="text-dark text-center">
                            <b v-if="tipo == 'Categorias'">{{ tipo }}</b>
                            <b v-if="tipo == 'Subcategorias'">
                                <a href="#" @click="getCategorias" class="text-info">Categorías</a>
	    						<i class="fas fa-arrow-right"></i>
	    					    Subcategorías
                            </b>
                            <b v-if="tipo == 'Productos'">
                                <a href="#" @click="getCategorias" class="text-info">Categorías</a>
                                <i class="fas fa-arrow-right"></i> 
                                <a href="#" @click="select(subcategoria,'Categorias')" class="text-info">Subcategorías</a>
                                <i class="fas fa-arrow-right"></i> 
                                Productos
                            </b>
                        </h3>
                        <hr>
                        <div class="row" style="padding: 5%; padding-top: 0px;">
                            <div class="col-6 col-md-3" v-for="item in lista" :key="item.id">
                                <div class="box box-primary box-solid">
                                    <div class="box-body" style="padding: 0px;">
                                        <a href="#" @click="select(item.id,tipo)" v-if="tipo != 'Productos'">
                                            <img :src=" path + '/storage/' + tipo + '/' + item.url" style="width: 100%; height: 100px;">
                                        </a>
                                        <a href="#" @click="addProducto(item.id,venta.id)" v-else>
                                            <img :src=" path + '/storage/' + tipo.toLowerCase() + '/' + item.url" style="width: 100%; height: 100px;">
                                        </a>
                                    </div>
                                    <div class="box-header" align="center" style="padding: 0px;">
                                        {{ item.name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div> 
    </div>
</template>

<script>
    export default {
        props: ['path','venta'],
        data(){
            return {
                lista : [],
                tipo : '',
                subcategoria: ''
            }
        },
        methods: {
            getCategorias(){
                axios.get('/getCategorias').then(response => {
                    this.lista = [];
                    response.data.forEach(element => {
                        this.lista.push({
                            id: element.id,
                            name: element.name,
                            url: element.url
                        });
                        this.tipo = 'Categorias';
                    });
                });
            },
            selCategorias(id){
                axios.get('/selcategorias/'+id).then(response => {
                    this.lista = [];
                    response.data.forEach(element => {
                        this.lista.push({
                            id: element.id,
                            name: element.name,
                            url: element.url
                        });
                        this.tipo = 'Subcategorias';
                    });
                });
            },
            async selSubcategorias(id){
                await axios.get('/selsubcategorias/'+id).then(response => {
                    this.lista = [];
                    response.data.forEach(element => {
                        this.lista.push({
                            id: element.id,
                            name: element.name,
                            url: element.url
                        });
                        this.subcategoria = element.categoria_id;
                        this.tipo = 'Productos';
                    });
                });
            },
            select(id,tipo){
                if(tipo == 'Categorias'){
                    this.selCategorias(id);
                }else{
                    this.selSubcategorias(id);
                }
            },
            async addProducto(producto,venta){
                const stock = await axios.get('/getStock/'+producto).then(response => response.data);
                if (stock > 0) {
                    const params = {
                        producto_id : producto,
                        venta_id : venta
                    }
                    await axios.post('/comandas/storeDetail', params).then(response => {
                        this.$emit('addRow',response.data);                        
                    });                    
                }else{
                    alert('No hay suficientes ingredientes.')
                }
            }
        },
        beforeMount(){
            this.getCategorias();
        }
    }
</script>

<style>

</style>