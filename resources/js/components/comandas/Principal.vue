<template>
    <div class="box box-solid box-dark">
        <div class="box-header">
            <Modal :path="path" :venta="ventaData" @addRow="addRow"></Modal>
            <h2 class="box-title">Orden {{ mesa }}</h2>
            <button 
                type="button"
                class="btn btn-sm btn-success float-right"
                data-toggle="modal"
                data-target=".productosModal">
                    Agregar <i class="fa fa-plus-circle"></i>
            </button>
        </div>
        <div class="box-body" style="padding: 0px;">
            <ul class="list-group">
                <Fila v-for="(item,index) in listaDetalles" 
                    :key="item.id" 
                    :item="item" 
                    :index="index" 
                    @deleteDetail="deleteDetail" 
                    @updateCant="updateCant"
                    @updateIngs="updateIngs"></Fila>
            </ul>
        </div>
        <!---->
    </div>
</template>

<script>
import Modal from './productos/Modal.vue'
import Fila from './orden/Fila.vue'
import { mapMutations } from 'vuex'
import { mapActions } from 'vuex'
    export default {
        props: ['mesa','path','venta'],
        data(){
            return {
                ventaData : JSON.parse(this.venta),
                listaDetalles : [],
            }
        },
        beforeMount(){
            this.getDetail();
            const params = {
                venta_id : this.ventaData.id,
                subtotal : this.ventaData.subtotal,
                descuento : this.ventaData.descuento,
                total : this. ventaData.total
            };
            this.defineState(params);
        },
        methods : {
            async getDetail(){
                await axios.get('/detalleVenta/'+this.ventaData.id).then(response => {
                    const data = response.data;
                    this.listaDetalles = [];
                    for(var i = 0; i < data[1].length; i++){
                        this.listaDetalles.push({
                            id: data[1][i].id,
                            options: data[2][i],
                            opSelected: data[3][i],
                            producto_id: data[1][i].producto_id,
                            name: data[1][i].name,
                            cantidad: data[1][i].cantidad,
                            precio_venta: data[1][i].precio_venta
                        });                        
                    }
                });
            },
            updateCant(params){
                this.listaDetalles[params.index].cantidad = params.cantidad;
            },
            updateIngs(params){
                this.listaDetalles[params.index].opSelected = params.ingSelected;
            },
            deleteDetail(index){
                this.listaDetalles.splice(index,1);
            },
            addRow(params){
                this.listaDetalles.push({
                    id: params.id,
                    options: params.options,
                    opSelected : params.opSelected,
                    producto_id: params.producto_id,
                    name: params.name,
                    cantidad: params.cantidad,
                    precio_venta: params.precio_venta
                });
            },
            ...mapMutations(['agregaSub']),
            ...mapActions(['defineState','calcula'])
        },
        components: {
            Modal,
            Fila
        },
        updated(){
            this.calcula();
            if (this.listaDetalles.length > 0) {
                $('#btnCancelar').css('display','none');
            }else{
                $('#btnCancelar').css('display','block');
            }
        }
    }
</script>

<style>

</style>