<template>
    <div class="modal fade" :id="'deleteModal'+item.id" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Desea eliminar el ingreso?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" @click="deleteItem">Eliminar</button>
                </div>
            </div>
        </div>  
    </div>
</template>

<script>
export default {
    props: ['item'],
    methods: {
        deleteItem(){
            this.$emit('deleteItem');
        }
    }
}
</script>

<style>

</style>