<template>
    <div>
        <form @submit.prevent="addNew" class="w-100 text-center">
            <div class="form-group">
                <label>Monto: </label>
                <input type="number" v-model="monto" class="form-control text-center" :max="maximo" placeholder="Ingresa el monto del gasto" min="1" step="any" required>
            </div>
            <div class="form-group">
                <label>Descripción: </label>
                <textarea v-model="descripcion" class="form-control" rows="3" placeholder="Ingresa descripción del gasto" required maxlength="200"></textarea>
            </div>
            <div class="form-group text-center">
                <button class="btn btn-primary">Registrar</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: 'FormGastos',
    props: ['maximo'],
    data(){
        return {
            monto: '',
            descripcion: ''
        }
    },
    methods: {
        async addNew(){
            const params = {
                monto : this.monto,
                descripcion : this.descripcion
            };
            await axios.post('/gasto',params).then(response => {
                this.$emit('addNew',response.data);
                $('.alert').html('Creado con éxito');
                $('.alert').fadeToggle(2000);
                $('.alert').fadeToggle(2000);
            });
            this.monto = '';
            this.descripcion = '';
        }
    }
}
</script>

<style>

</style>