<div class="modal fade" id="deleteCategoria{{ $categoria->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header bg-danger">
            <h4 class="modal-title" id="myModalLabel">Eliminar categoría</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body">
           <h3>Desea borrar la categoría {{$categoria->name}}?</h3>
            <div align="center">
              @if($categoria->url != "vacio")
                <img src="{{ asset('storage/categorias/' . $categoria->url) }}" class="img-responsive" width="100" height="100">
              @endif
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger" form="fDelete{{ $categoria->id }}">Eliminar</button>
         </div>
      </div>
   </div>
</div>
