<template>
    <div class="row justify-content-center">

        <div class="col-12 col-md-6">
            <form-unidad-component @new="addUnidad"></form-unidad-component>
        </div>
        <div class="col-12 col-md-6">
            <ul class="list-group">
                <unidad-component
                    v-for="(unidad, index) in unidades"
                    :key="unidad.id"
                    :unidad="unidad"
                    @update="updateUnidad(index, ...arguments)"
                    @delete="deleteUnidad(index)">
                </unidad-component>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                unidades: []
            }
        },

        mounted() {
            axios.get('/unidad/getUnidades').then((response) => {
                this.unidades = response.data;
            });
        },

        methods: {
            addUnidad(unidad) {
                this.unidades.push(unidad);
            },
            updateUnidad(index, unidad) {
                this.unidades[index] = unidad;
            },
            deleteUnidad(index) {
                this.unidades.splice(index, 1);
            }
        }
    }
</script>
