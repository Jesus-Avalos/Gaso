<template>
    <li class="list-group-item">
        <input v-if="editMode" type="text" class="form-control mb-1" v-model="unidad.name">
        <strong v-else>{{ unidad.name }}</strong>
        <button class="btn btn-sm btn-danger float-right ml-2" v-on:click="onClickDelete()">
            <i class="fas fa-trash"></i>
        </button>
        <button v-if="editMode" class="btn btn-sm btn-success float-right" v-on:click="onClickUpdate()">
            Guardar
        </button>
        <button v-else class="btn btn-sm btn-info float-right" v-on:click="onClickEdit()">
            <i class="fas fa-edit"></i>
        </button>
    </li>
</template>

<script>
    export default {
        props: ['unidad'],
        data() {
            return {
                editMode: false
            };
        },
        methods: {
            onClickDelete() {
                var conf = confirm(`Deseas eliminar el elemento ${this.unidad.name}?`);
                if(conf){
                    axios.delete(`/unidad/${this.unidad.id}`).then(() => {
                        this.$emit('delete');
                    });
                }
            },
            onClickEdit() {
                this.editMode = true;
            },
            onClickUpdate() {
                const params = {
                    name: this.unidad.name
                };
                axios.put(`/unidad/${this.unidad.id}`, params).then((response) => {
                    this.editMode = false;
                    const unidad = response.data;
                    this.$emit('update', unidad);
                });
            }
        }
    }
</script>
