<div class="modal fade" id="newSub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header bg-blue">
            <h4 class="modal-title" id="myModalLabel">Nueva Subcategoría</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
      {{ Form::open(['route'=>'subcategoria.store', 'method' =>'POST','files'=>true]) }}
         {{ Form::token() }}
         <div class="modal-body">
            @include('subcategoria.forms.form')
            <div id="preview" style="padding-left: 10%;"></div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Crear</button>
         </div>
      {{ Form::close() }}
      </div>
   </div>
</div>
