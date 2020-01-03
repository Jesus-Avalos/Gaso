<div class="modal fade" id="deleteProducto{{ $producto->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header bg-danger">
            <h4 class="modal-title" id="myModalLabel">Eliminar producto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body">
            <div>
               <h3>Desea borrar el producto</h3>
               <h3><strong>{{$producto->name}}</strong></h3>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger" form="fDelete{{ $producto->id }}">Eliminar</button>
         </div>
      </div>
   </div>
</div>
