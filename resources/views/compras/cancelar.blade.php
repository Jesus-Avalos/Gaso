<div class="modal fade modal-danger" tabindex="-1" role="dialog" id="cancelar{{ $compra->id }}">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header bg-danger">
             <h4 class="modal-title">Confirmar cancelación!!</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
 
          <div class="modal-body">
             <h3>Desea cancelar la compra?</h3>
          </div>
 
          <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger" form="fDelete{{ $compra->id }}">Confirmar</button>
          </div>
       </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->