<template>
    <form @submit.prevent="reabastecer">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ingredientes">Ingredientes</label>
                    <select name="ingredientes" class="selectpicker form-control" data-live-search="true" v-model="ing" required>
                        <ings v-for="ing in ings" :key=ing.id :ing="ing"></ings>
                    </select>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" min="1" class="form-control text-center" v-model="cantidad" required>
                </div>
            </div>
            <div class="col-6 col-md-2 text-center">
                <br>
                <button class="btn btn-primary mt-2 mb-2">Añadir</button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    data(){
        return {
            ings    : [],
            ing     : '',
            cantidad: 1
        }
    },
    mounted(){
        axios.get('/inventario/getIngs').then((response) => {
            this.ings = response.data;
        });
    },
    methods : {
        reabastecer(){
            const params = {
                ing : this.ing,
                cantidad: this.cantidad
            }

            axios.post('/inventario/reabastecer',params).then((response)=>{
                $('#alertSuccess').html(`Se reabastecieron <strong>${this.cantidad}</strong> unidades al producto <strong>${response.data.nombre}</strong>`);
                $('#alertSuccess').fadeToggle(4000);
                $('#alertSuccess').fadeToggle(4000);
                this.cantidad = 1;
            })
        }
    }
}
</script>

<style>

</style>