<div class="box box-solid box-dark">
	<div class="box-header">
		<h2 class="box-title">Datos venta</h2>
		<a href="/venta/cancelar/{{ $venta->id }}" class="btn btn-sm btn-danger float-right" id="btnCancelar" style="display: none">Cancelar</a>
	</div>
	<div class="box-body" >
		<div class="row">
			<div class="col-12 mb-2">
				@include('forms.alertsCP')
				<h4 class="mb-0">Datos cliente</h4>
				<div align="center" class="border-bottom pb-2">
					<comanda-cliente cliente_id="{{ $venta->cliente_id }}" venta_id="{{ $venta->id }}"></comanda-cliente>
				</div>
			</div>
			<div class="col-12" align="center">
				<comanda-pay></comanda-pay>
			</div>
		</div>
	</div>
</div>

@section('scripts')
	<script>
		function fDesechable(){
			var check = document.getElementById('customSwitch');
			if (check.checked == true) {
				$('#selectDesechable').removeAttr('disabled');
				$('.selectpicker').selectpicker('refresh');
			}else{
				$('#selectDesechable').attr('disabled','true');
				$('.selectpicker').selectpicker('refresh');
			}
		}
	</script>
@endsection