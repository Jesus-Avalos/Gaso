<div class="modal fade modal-danger" tabindex="-1" role="dialog" id="eliminarUser{{ $user->id }}">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Confirmar eliminación!!</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>

         <div class="modal-body">
            <h3>Desea eliminar {{ $user->name }}?</h3>
         </div>

         <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
               <button type="submit" class="btn btn-danger" form="formUser{{ $user->id }}">Confirmar</button>
         </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->