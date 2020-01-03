<div class="modal fade limpiarModal{{ $mesa->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
		<div class="modal-body">
			<h3>Limpiar {{ $mesa->name }}!!</h3>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        	<button type="button" class="btn btn-primary" onclick="flimpiarMesa({{ $mesa->id }})">Limpiar</button>
		</div>
    </div>
  </div>
</div>