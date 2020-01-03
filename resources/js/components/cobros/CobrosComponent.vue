<template>
    <tr>
        <td v-if="mostrar">
            <button class="btn btn-success btn-sm" v-if="edit" :data-target="'.vuelto'+cobro.id" data-toggle="modal">Cobrar</button>
            <a href="#" v-if="cancelar" class="btn btn-danger btn-sm" 
            title="Cancelar" data-toggle="modal" :data-target="'.modalCancelar' + cobro.id">
                <i class="fa fa-ban"></i>
            </a>
        </td>
        <td>{{ cobro.id }}</td>
        <td>{{ cobro.tipo }}</td>
        <td>{{ (cobro.name == null)? 'No Aplica' : cobro.name }}</td>
        <td>{{ cobro.nombre }}</td>
        <modal-cobro-component :cobro="cobro"></modal-cobro-component>
        <Vuelto :cobro="cobro" @cobrar="$emit('cobrar')"></Vuelto>
    </tr>
</template>

<script>
    import Vuelto from './ModalVuelto';
    export default {
        props : ['cobro','cancelar','edit','mostrar'],
        data () {
            return {

            }
        },
        components:{
            Vuelto
        }
    }
</script>
