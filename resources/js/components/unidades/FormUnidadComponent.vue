<template>
    <div class="card">
        <h5 class="card-header">Unidades</h5>
        <div class="card-body">
            <form action="" v-on:submit.prevent="newUnidad()">
                <div class="form-group">
                    <label for="thought">Nueva unidad:</label>
                    <input type="text" class="form-control" name="name" v-model="name">
                </div>
                <button type="submit" class="btn btn-info">
                    Crear unidad
                </button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: ''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            newUnidad() {
                const params = {
                    name: this.name
                };
                this.name = '';

                axios.post('/unidad', params)
                    .then((response) => {
                        const unidad = response.data;
                        this.$emit('new', unidad);
                    });
            }
        }
    }
</script>
