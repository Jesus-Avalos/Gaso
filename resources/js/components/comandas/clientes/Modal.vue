<template>
    <div class="modal fade modal-primary clienteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="addCliente" id="clientes">
                        <div class="row">
                            <div class="col-12">
                                <div class="from-group">
                                    <label for="nombre">Nombre*: </label>
                                    <input type="text" class="form-control" required v-model="cliente.nombre">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="from-group">
                                    <label for="domicilio">Domicilio: </label>
                                    <input type="text" class="form-control" v-model="cliente.domicilio">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="from-group">
                                    <label for="colonia">Colonia: </label>
                                    <input type="text" class="form-control" v-model="cliente.colonia">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="from-group">
                                    <label for="referencia">Referencia: </label>
                                    <input type="text" class="form-control" v-model="cliente.referencia">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="from-group">
                                    <label for="telefono">Teléfono: </label>
                                    <input type="number" class="form-control" v-model="cliente.telefono">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success" form="clientes">Registrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</template>

<script>
export default {
    name: 'Modal',
    props: ['venta'],
    data(){
        return {
            cliente: {
                venta: this.venta,
                nombre: '',
                domicilio: '',
                colonia: '',
                referencia: '',
                telefono: ''
            }
        }
    },
    methods: {
        addCliente(){
            axios.post('/comandas/clienteNew',this.cliente).then(response => {
                this.$emit('addCliente',response.data);
                $('.clienteModal').modal('hide');
            });
        }
    }

}
</script>

<style>

</style>