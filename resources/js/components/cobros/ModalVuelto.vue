<template>
    <div :class="'modal fade modal-primary vuelto'+cobro.id" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cobrar comanda!!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-12 mb-2">
                            <label>Total a pagar: </label>
                            <h3>${{ cobro.total }}</h3>
                        </div>
                        <div class="col-12 mb-2">
                            <label>Tipo pago: </label>
                            <select name="tipo" id="" v-model="sTipo" class="selectpicker form-control" @change="modeType">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Tarjeta">Tarjeta crédito</option>
                                <option value="Credito" v-if="cobro.cId != 1">Crédito</option>
                            </select>
                        </div>
                        <div class="col-12 mb-2" v-if="modeAdelanto">
                            <label>Adelanto: </label>
                            <input type="number" step="any" :max="cobro.total" min="0" v-model="adelanto" class="form-control text-center" value="0">
                        </div>
                        <div class="col-12 mb-2" v-if="modeEfectivo">
                            <label>Paga con: </label>
                            <input type="number" step="any" :min="cobro.total" v-model="recibe" class="form-control text-center" @input="calculaVuelto">
                        </div>
                        <div class="col-12" v-if="modeEfectivo">
                            <label>Vuelto: </label>
                            <h3 :class=" colorTexto "><b>${{ sobra }}</b></h3>
                        </div>
                    </div>
                </div>
        
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-success" data-dismiss="modal" @click="onClickCobrar(cobro.id)">Cobrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</template>

<script>
export default {
    name : 'Vuelto',
    props: ['cobro'],
    data(){
        return {
            recibe: '',
            sTipo : 'Efectivo',
            sobra : 0,
            adelanto : 0,
            modeAdelanto: false,
            modeEfectivo: true
        }
    },
    computed: {
        colorTexto(){
            return (this.sobra < 0) ? 'text-danger' : 'text-success';
        }
    },
    methods: {
        onClickCobrar (id){

            const params = {
                id: id,
                tipo: this.cobro.tipo,
                tipoPago: this.sTipo,
                adelanto: this.adelanto
            }
            axios.post('/cobro/pagarCuenta',params).then((response) => {
                this.$emit('cobrar');
                $('#alertSuccess').html(response.data);
                $('#alertSuccess').fadeToggle(1500);
                $('#alertSuccess').fadeToggle(1500);
            })
        },
        calculaVuelto(){
            var total = this.recibe - this.cobro.total;
            this.sobra = total;
        },
        modeType(){
            switch(this.sTipo){
                case 'Efectivo': this.modeAdelanto = false; this.modeEfectivo = true; break;
                case 'Tarjeta' : this.modeEfectivo = false; this.modeAdelanto = false; break;
                case 'Credito' : this.modeAdelanto = true; this.modeEfectivo = false; break;
            }
        }
    },
    updated(){
        $('.selectpicker').selectpicker('refresh');
    },
    mounted(){
        $('.selectpicker').selectpicker('refresh');
    }
}
</script>

<style>

</style>