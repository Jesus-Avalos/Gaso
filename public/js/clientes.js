function fexistente(){
	$("#btnVolver").css("display","block");
	$.get('/getClientes', function(data){
		$('#clienteDiv').html('<input type="hidden" name="opcionCliente" value="si">');

		$('#clienteDiv').append(`
			<div class="row justify-content-center">
				<div class="col-12 col-md-6">
					<select name="cliente_id" class="form-control selectpicker" data-live-search="true">
						${data}
					</select>
				</div>
			</div>
		`);
		$('.selectpicker').selectpicker('refresh');
	});

}

function fnuevoCliente(){
	$("#btnVolver").css("display","block");
	$.get('/getFormClientes', function(data){
		$('#clienteDiv').html('<input type="hidden" name="opcionCliente" value="no">');

		$('#clienteDiv').append(data);
	});

}

function fvalidarFormCC(){

}

function fvolver(){
	$("#btnVolver").css("display","none");
	$('#clienteDiv').html(`
		<button class="btn btn-primary btn-sm" type="button" onclick="fexistente()">Existente</button>
		<button class="btn btn-primary btn-sm" type="button" style="width: 79px; margin-left: 5%;" onclick="fnuevoCliente()">Nuevo</button>
	`);
}