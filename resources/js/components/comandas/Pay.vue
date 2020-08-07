<template>
    <div class="mb-2 border-bottom pb-2">
        <div class="row" style="font-size: 18px;">
            <div class="col-md-2">
                <b>Subtotal: </b>
            </div>
            <div class="col-md-2">$ <span>{{ getSubtotal }}</span></div>
            <div class="col-md-2">
                <b>Descuento: </b>
            </div>
            <div class="col-md-2 row justify-content-center">
                <span v-if="!modeDescuento">$ {{ getDescuento }}</span>
                <input type="number" class="text-center form-control w-75" v-model="descuento" min="0" v-else/>
                <button class="btn btn-info btn-sm float-right ml-2" type="button" @click="modeDescuento = !modeDescuento" v-if="!modeDescuento"><i class="fas fa-edit"></i></button>
                <button class="btn btn-success btn-sm float-right ml-2" type="button" @click="fDescuento" v-else><i class="fas fa-check"></i></button>
            </div>
            <div class="col-md-2">
                <b>Total: </b>
            </div>
            <div class="col-md-2">$ <b><span>{{ getTotal }}</span></b></div>
        </div>	
    </div>	
</template>

<script>
    import { mapGetters } from 'vuex'
    import { mapActions } from 'vuex'
    export default {
        data (){
            return {
                descuento: this.getDescuento,
                modeDescuento : false
            }
        },
        methods: {
            ...mapActions(['calcula','updateDescuento']),
            fDescuento(){
                this.descuento = (this.descuento == null || this.descuento == '') ? 0 : this.descuento;
                this.updateDescuento(parseInt(this.descuento))
                this.modeDescuento = !this.modeDescuento
            }
        },
        computed: {
            ...mapGetters(['getSubtotal','getDescuento','getTotal'])
        }
    }
</script>

<style>

</style>