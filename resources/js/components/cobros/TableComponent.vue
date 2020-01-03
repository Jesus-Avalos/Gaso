<template>
    <table class="dt-responsive table table-bordered" id="cobrosTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col" v-if="mostrar"><i class="fa fa-wrench"></i></th>
                <th scope="col">Folio</th>
                <th scope="col">Tipo</th>
                <th scope="col">Mesa</th>
                <th scope="col">Cliente</th>
            </tr>
        </thead>
        <tbody>
            <cobro-component 
                v-for="(cobro,index) in cobros"
                :key="cobro.id"
                :cobro="cobro" 
                :cancelar="cancelar"
                :edit="edit"
                :mostrar="mostrar"
                @cobrar="cobrar(index)">                
            </cobro-component>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: [
            'cancelar','edit'
        ],
        data () {
            return {
                cobros : []
            }
        },
        beforeMount() {
            this.getVentas();
            
        },
        methods: {
            cobrar (index){
                this.cobros.splice(index,1);
                $('#cobrosTable').DataTable().destroy();
                this.initDT();
            },
            initDT () {
                $(function(){
                     $('#cobrosTable').DataTable({
                        "order": [[ 1, "desc" ]],
                        "autoWidth" : false,
                        "paging" : false,
                        "bInfo" : false,
                        "pageLength": -1
                    });
                })
            },
            getVentas (){
                axios.get('/cobro/getVentas').then((response) => {
                    this.cobros = response.data;
                    this.initDT();
                })
            }
        },
        computed:{
            mostrar(){
                if (this.cancelar != 0 || this.edit != 0) {
                    return 1;
                }else{
                    return 0;
                }
            }
        }
    }
</script>
