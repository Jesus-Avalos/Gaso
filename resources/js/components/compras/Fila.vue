<template>
    <tr>
        <td>
            <button class="btn btn-sm btn-secondary" type="button" data-target=".detailModal" data-toggle="modal" @click="detailUp"><i class="fas fa-bars"></i></button>
            <button class="btn btn-sm btn-danger" @click="deleteRow" type="button"><i class="fas fa-trash"></i></button>
        </td>
        <td>
            <input type="hidden" name="inventario_id[]" :value="ingId.id">
            {{ ingId.nombre }}
        </td>
        <td>
            {{ ingId.nameU }}
        </td>
        <td>
            <input type="number" min="1" step="any" name="cantidad[]" :id="'cant'+ingId" class="form-control" @blur="validaCero" @input="cantidad = $event.target.value" :value="cantidad">
        </td>
        <td>
            <input type="number" step="any" min="0" name="precio_unidad[]" class="form-control" v-model="precio_u">
        </td>
        <td>
            <input type="hidden" name="subtotal[]" :value="subtotal" class="subtotales">
            $ {{ subtotal }}
        </td>
    </tr>
</template>

<script>

import Vuex from 'vuex';
    export default {
        props : ['ingId','ind'],
        data(){
            return {
                cantidad : 1,
                precio_u : this.ingId.precio_unidad,
                sub : 0
            }
        },
        methods: {
            fcantidad(cant){
                this.cantidad = cant;
            },
            detailUp(){
                this.$emit('detailUp',this.ingId);
            },
            validaCero(){
                if(this.cantidad == ''){this.cantidad = 1}
            },
            deleteRow(){
                this.$emit('delete',this.ind);
            },
            chgSub(){
                this.$emit('fTotal');
            },
            ...Vuex.mapMutations(['agregaSub'])
        },
        computed : {
            subtotal(){
                var total = this.precio_u * this.cantidad;
                return total;
            }
        },
        updated(){
            // console.log(this.subtotal);
            this.agregaSub();
        },
        mounted(){
            // console.log(this.subtotal);
            this.agregaSub();
        },
        destroyed(){
            // console.log(this.subtotal);
            this.agregaSub();
        }
    }
</script>

<style>

</style>