<template>
    <div class="modal fade modal-primary createArticulo" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Artículo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="addArticulo" id="articulos">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre del Artículo*: </label>
                                    <input type="text" class="form-control" required v-model="articulo.nombre">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="from-group">
                                    <label for="tipo">Tipo*: </label>
                                    <select class="selectpicker form-control" required v-model="articulo.tipo">
                                        <option :value="item" v-for="(item, index) in sTipo" :key="index">{{ item }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="from-group">
                                    <label for="unidad">Unidad*: </label>
                                    <select v-model="articulo.unidad" class="selectpicker form-control" required>
                                        <option :value="item.id" v-for="(item, index) in sUnidades" :key="index">{{ item.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="cantidad">Cantidad*: </label>
                                    <input type="number" v-model="articulo.cantidad" class="form-control" min="0" step="any" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="por_unidad">Porciones por unidad*: </label>
                                    <input type="number" v-model="articulo.por_unidad" class="form-control" min="1" step="any" value="1" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="precio_unidad">Precio por unidad*: </label>
                                    <input type="number" v-model="articulo.precio_unidad" class="form-control" min="0" step="any" required value="0">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="stock_min">Stock mínimo*: </label>
                                    <input type="number" v-model="articulo.stock_min" class="form-control" min="0" step="any" required value="0">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        
                <div class="modal-footer">
                    <button type="submit" form="articulos" class="btn btn-sm btn-success">Registrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</template>

<script>
export default {
    name: 'CreateArticulo',
    data(){
        return {
            sTipo: [
                'Ingrediente',
                'Material',
                'Desechable',
                'Requerido'
            ],
            sUnidades : [],
            articulo: {
                name: '',
                tipo: '',
                unidad: 0,
                cantidad: 0,
                por_unidad: 0,
                precio_unidad: 0,
                stock_min: 0
            }
        }
    },
    beforeMount(){
        this.getUnidades();
    },
    methods: {
        getUnidades(){
            axios.get('/getUnidades').then(response => {
                var datos = response.data;
                datos.forEach(element => {
                    this.sUnidades.push(element);
                });
            });
        },
        addArticulo(){
            axios.post('/inventario',this.articulo).then(response => {
                this.$emit('addArticulo');
            });
        }
    },
    updated(){
        $('.selectpicker').selectpicker('refresh');
    }
}
</script>

<style>

</style>