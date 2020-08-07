<template>
    <li class="list-group-item">
        <input type="hidden" :value="item.producto_id" name="producto_id[]">
        <div class="row">
            <div class="col-10">
                <h4><b>{{ item.name }}</b></h4>
            </div>
            <div class="col-2 text-right">
                <button class="btn btn-danger btn-sm" type="button" @click="deleteDetail(item.id)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
        <div class="row" style="margin-bottom: 3px;">
            <div class="col-8">
                Cantidad:
                <span v-if="!modeCant" class="mr-2">{{ cantidadModel }}</span>
                <input v-else type="number" name="cantidad[]"
                    style="width: 50px; text-align: center;" 
                    v-model="tempCant">
                <button type="button" title="Editar cantidad" class="btn btn-secondary btn-sm" v-if="!modeCant" @click="modeCant = !modeCant"><i class="fas fa-pen"></i></button>
                <button type="button" title="Actualizar cantidad" class="btn btn-success btn-sm" v-else @click="chgCant(item.id)"><i class="fas fa-check"></i></button>
                <button type="button" title="Disminuir" class="btn btn-danger btn-sm" v-if="!modeCant" @click="disminuirCantidad(item.id)"><i class="fas fa-minus"></i></button>
                <button type="button" title="Aumentar" class="btn btn-success btn-sm" v-if="!modeCant" @click="aumentaCantidad(item.id)"><i class="fas fa-plus"></i></button>
                <button type="button" title="Editar ingredientes" class="btn btn-primary btn-sm" @click="showIngs = !showIngs"><i class="fas fa-edit"></i></button>
            </div>
            <div class="col-4 text-right">
                <h2 style="margin: 0px;">$<span>{{ precio_total }}</span></h2>
                <input type="hidden" v-model="precio_total" class="subtotales">
            </div>
        </div>
        <div class="row justify-content-left" v-if="showIngs">
            <div class="col-12 col-md-5">
                <select class="selectpicker form-control float-left" @change="updateIngs(item.id)" multiple style="width: 300px;" v-model="selected" v-html="item.options"></select>
            </div>
        </div>
    </li>
</template>

<script>
import { mapActions } from 'vuex'
export default {
    props:['item','index'],
    data(){
        return {
            cantidadModel : this.item.cantidad,
            tempCant : this.item.cantidad,
            selected : this.item.opSelected,
            showIngs: false,
            modeCant: false
        }
    },
    methods: {
        async aumentaCantidad(id){
            const stock = await axios.get('/getStock/'+this.item.producto_id).then(response => response.data);
            if (stock > 0) {
                this.cantidadModel++;
                this.tempCant++;
                this.putCant(id);
            }else{
                alert('No hay suficientes ingredientes.')
            }
        },
        async chgCant(id){
            var cant = (this.tempCant == '' || this.tempCant == null) ? 1 : this.tempCant;
            const stock = await axios.get('/getStock/'+this.item.producto_id).then(response => response.data);
            if (cant != this.cantidadModel) {
                if (cant > this.cantidadModel) {
                    var totalCant = this.cantidadModel + stock;
                    if(cant > totalCant){
                        alert('La cantidad máxima es de: ' + totalCant);
                        this.tempCant = totalCant;
                    }else{
                        this.cantidadModel = cant;
                        this.putCant(id);
                        this.modeCant = !this.modeCant;
                    }
                }else{
                    this.cantidadModel = cant;
                    this.putCant(id);
                    this.modeCant = !this.modeCant;
                }
            }else{
                this.modeCant = !this.modeCant;
            }
        },
        disminuirCantidad(id){
            if (this.cantidadModel > 1) {
                this.cantidadModel--;
                this.tempCant--;
                this.putCant(id);
            }
        },
        async updateIngs(id){
            const params = {
                ingSelected: this.selected,
                index: this.index
            }
            await axios.put('/comandas/updateIngs/'+id, params).then(response => {
                this.$emit('updateIngs',params);
            });
        },
        async deleteDetail(id){
            await axios.delete('/comandas/deleteDetail/'+id).then(response => response.data);
            this.$emit('deleteDetail',this.index);
        },
        async putCant(id){
            const params = {
                cantidad: this.cantidadModel,
                index: this.index,
                precio_total: this.precio_total
            }
            await axios.put('/comandas/updateCantidad/'+id,params).then(response => response.data);
            this.$emit('updateCant',params);
        },
        ...mapActions(['calcula'])
    },
    computed: {
        precio_total(){
            return this.item.precio_venta * this.cantidadModel;
        }
    },
    updated(){
        this.calcula();       
        $('.selectpicker').selectpicker();
    },
    mounted(){
        $('.selectpicker').selectpicker('refresh');
    }
}
</script>

<style>

</style>