<template>
    <div class="modal fade modal-primary createProovedor" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Proovedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="addProovedor" id="proovedores">
                        <div class="row">
                            <div class="col-12">
                                <div class="from-group">
                                    <label for="nombre">Nombre*: </label>
                                    <input type="text" class="form-control" required v-model="proovedor.nombre">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="from-group">
                                    <label for="domicilio">Domicilio: </label>
                                    <input type="text" class="form-control" v-model="proovedor.domicilio">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="from-group">
                                    <label for="colonia">Colonia: </label>
                                    <input type="text" class="form-control" v-model="proovedor.colonia">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="from-group">
                                    <label for="referencia">Referencia: </label>
                                    <input type="text" class="form-control" v-model="proovedor.referencia">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="from-group">
                                    <label for="telefono">Teléfono: </label>
                                    <input type="number" class="form-control" v-model="proovedor.telefono">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success" form="proovedores">Registrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</template>

<script>
export default {
    name: 'createProovedor',
    data(){
        return {
            proovedor: {
                nombre: '',
                domicilio: '',
                colonia: '',
                referencia: '',
                telefono: ''
            }
        }
    },
    methods: {
        addProovedor(){
            axios.post('/proovedor',this.proovedor).then(response => {
                this.$emit('addProovedor');
            });
        }
    }

}
</script>

<style>

</style>