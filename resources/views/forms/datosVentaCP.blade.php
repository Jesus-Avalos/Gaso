<div class="box box-solid box-dark">
	<div class="box-header">
		<h2 class="box-title">Datos venta</h2>
		<button class="btn btn-info btn-sm float-right" id="btnVolver" onclick="fvolver()" style="display: none;" type="button">Volver</button>
	</div>
	<div class="box-body" >
		<div class="row">
			<div class="col-12 mb-2">
				@include('forms.alertsCP')
				<h4 class="mb-0">Datos cliente</h4>
				<div id="clienteDiv" align="center" class="border-bottom pb-2">
					@if(isset($cliente))
						<p>Cliente: <strong>{{ $cliente->nombre }}</strong></p>
					@endif
					<button class="btn btn-primary btn-sm" type="button" onclick="fexistente()">Existente</button>
					<button class="btn btn-primary btn-sm" type="button" style="width: 79px; margin-left: 5%;" onclick="fnuevoCliente()">Nuevo</button>
				</div>
			</div>
			<div class="col-12" align="center">
				<div class="mb-2 border-bottom pb-2">
					<div class="row" style="font-size: 18px;">
						<div class="col-md-2">
							<b>Subtotal: </b>
							{{Form::hidden('subtotal',0)}}
						</div>
						<div class="col-md-2">$ <span id="subSpan">0</span></div>
						<div class="col-md-2">
							<b>Descuento: </b>
							{{Form::hidden('descuento',0)}}
						</div>
						<div class="col-md-2">$ <span id="descSpan">0</span></div>
						<div class="col-md-2">
							<b>Total: </b>
							{{Form::hidden('total',0)}}
						</div>
						<div class="col-md-2">$ <b><span id="totalSpan">0</span></b></div>
					</div>	
				</div>	
				<div class="row">
					<div class="col">
						<div class="custom-control custom-switch">
							{!! Form::checkbox(null, null, null, ['id'=>'customSwitch','class'=>'custom-control-input','onchange'=>'fDesechable()']) !!}
							<label class="custom-control-label" for="customSwitch">
								Desechable
								{!! Form::select('desechable', $desechables, null, ['class'=>'form-control selectpicker','id'=>'selectDesechable','disabled']) !!}
							</label>
						</div>	
					</div>
					<div class="col pt-3">
						<button class="btn btn-sm btn-success" type="button" style="margin-right: 3px;" data-toggle="modal" data-target="#descModal" onclick="getDesc()">Descuento</button>
					</div>
					<div class="col pt-3">
						<button class="btn btn-sm btn-primary" type="submit" style="display:none;" id="GuardarBoton">Guardar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@section('scripts')
	{{ Html::script('/js/prints.js') }}
	{{ Html::script('/js/comandas.js') }}
	{{ Html::script('/js/clientes.js') }}
	{{ Html::script('/js/descuento.js') }}
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