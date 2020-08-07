<template>
    <div class="modal fade modal-primary detailModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title">Detalle artículo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                    <div class="modal-body" align="center">
                        <table>
                            <tbody>
                                <tr><td><strong>Nombre: </strong></td><td>{{ detail.nombre }}</td></tr>
                                <tr><td><strong>Tipo: </strong></td><td>{{ detail.tipo }}</td></tr>
                                <tr><td><strong>Unidad: </strong></td><td>{{ detail.nameU }}</td></tr>
                                <tr><td><strong>Cantidad: </strong></td><td>{{ detail.cantidad }}</td></tr>
                                <tr><td><strong>Porción por unidad: </strong></td><td>{{ detail.por_unidad }}</td></tr>
                                <tr><td><strong>Porciones: </strong></td><td>{{ detail.porciones }}</td></tr>
                                <tr><td><strong>Precio por unidad: </strong></td><td>{{ detail.precio_unidad }}</td></tr>
                                <tr><td><strong>Precio por porción: </strong></td><td>{{ detail.precio_porcion }}</td></tr>
                                <tr><td><strong>Stock mínimo: </strong></td><td>{{ detail.stock_min }}</td></tr>
                            </tbody>
                        </table>
                    </div>
            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</template>

<script>
export default {
    name : 'Detail',
    props: ['detail']
}
</script>