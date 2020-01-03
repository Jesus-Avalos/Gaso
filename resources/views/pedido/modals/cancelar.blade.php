<div class="modal fade modal-primary modalCancelar{{ $venta->id }}" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmar cancelación!!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-12 col-md-6">
                            <a href="/cancelar/sperdidas/{{ $venta->id }}" class="btn btn-success btn-sm">Sin Perdidas</a>
                        </div>
                        <div class="col-12 col-md-6">
                            <a href="/cancelar/cperdidas/{{ $venta->id }}" class="btn btn-danger btn-sm">Con Perdidas</a>
                        </div>
                    </div>
                </div>
        
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->