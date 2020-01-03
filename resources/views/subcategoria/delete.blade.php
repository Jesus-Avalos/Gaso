<div class="modal fade" id="deleteSub{{ $sub->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header bg-danger">
            <h4 class="modal-title" id="myModalLabel">Eliminar Subcategoría</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body">
           <h3>Desea borrar la Subcategoría <b>{{$sub->name}}</b>?</h3>
            <div align="center">
              @if($sub->url != "vacio")
                <img src="{{ asset('storage/subcategorias/' . $sub->url) }}" class="img-responsive" width="100" height="100">
              @endif
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger" form="fDelete{{ $sub->id }}">Eliminar</button>
         </div>
      </div>
   </div>
</div>
