<div class="modal fade modal-primary modalCorte" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmar corte!!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            
            {{ Form::open(['url'=>'cortes','method' => 'post']) }}
                <div class="modal-body">
                    @if($numVentas[0]->count)
                        <div class="form-group">
                            <label for="apertura">Apertura de caja $:</label>
                            <input type="number" class="form-control text-center" min="0" value="0" name="apertura" required>
                        </div>
                        <div class="form-group">
                            <label for="recuento">Recuento $:</label>
                            <input type="number" class="form-control text-center" step="any" min="0" name="recuento" value="{{ $recuento }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="caja">Dinero en caja $:</label>
                            <input type="number" class="form-control text-center" min="0" value="0" name="caja" required>
                        </div>
                    @else
                        <h3>No hay ventas en este turno</h3>
                    @endif
                </div>
        
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    @if($numVentas[0]->count)
                        <button type="submit" class="btn btn-primary">Realizar</button>
                    @endif
                </div>
            {{ Form::close() }}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->