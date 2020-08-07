<template>
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <select id="cliente_id" class="form-control selectpicker w-75" data-live-search="true" @change="updatedCliente" v-model="cliente">
                <option v-for="cliente in clientesData" :key="cliente.id" :value="cliente.id">{{ cliente.nombre }}</option>
            </select>
            <Modal @addCliente="addCliente" :venta="venta_id"></Modal>
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target=".clienteModal"><i class="fas fa-plus"></i></button>
        </div>
    </div>
</template>

<script>
import Modal from './Modal.vue'
export default {
    props : ['venta_id','cliente_id'],
    data() {
        return {
            venta : this.venta_id,
            cliente : this.cliente_id,
            clientesData : []
        }
    },
    methods : {
        async updatedCliente(){
            const params = {
                cliente_id : this.cliente
            }
            await axios.put('/comandas/updateCliente/'+this.venta,params);
        },
        async getClientes(){
            await axios.get('/clientes').then(response => {
                this.clientesData = [];
                const data = response.data;                
                data.forEach(element => {
                    this.clientesData.push(element);
                });
            });
        },
        async addCliente(id){
            await this.getClientes();
            this.cliente = id;
            $('#cliente_id').change();
        }
    },
    beforeMount(){
        this.getClientes();
    },
    updated(){
        $('.selectpicker').selectpicker('refresh');
    },
    components : {
        Modal
    }
}
</script>

<style>

</style>