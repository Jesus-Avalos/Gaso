<div class="modal fade" id="descModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Descuento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin: 5%;" align="center">
          {{Form::token()}}
          <label for="desc">Descuento: </label>
          {{ Form::number('desc', 0, ['class' => 'form-control','min'=>'0','max'=>'0','autocomplete'=>'off']) }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="descReal()">Realizar</button>
      </div>
    </div>
  </div>
</div>