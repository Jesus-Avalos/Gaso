$(document).ready(function(){
	if(rutaActual == '/cobro'){
		fgetVentasCobro();
	}
})

function fgetVentasCobro(){
	$.get('/cobro/getVentas', function(data){
		if (data.length > 0) {
			$.each( data, function( key, value ) {
				$('#tbodyCobros').append('' +
					'<tr>' +
						'<td>'+value.id+'</td>' +
	                  	'<td>'+value.nombre+'</td>' +
	                  	'<td>'+value.tipo+'</td>' +
	                  	'<td>'+value.name+'</td>' +
	                  	'<td><button onclick="fpagoVenta('+value.id+')" class="btn btn-success">Pagar</button></td>' +
					'</tr>');
			});
		}else{
			$('#tbodyCobros').append('' +
					'<tr>' +
						'<td colspan="5"><h3>No hay cobros pendientes</h3></td>' +
					'</tr>');
		}
	});
}

function fshowVenta(){

}

function fpagoVenta(id){
	alert('Pagando ..');
	$.get('/cobro/pagarCuenta/' + id, function(data){
		alert('Listo..... Pagado');
		$("#tbodyCobros").load(location.href + " #tbodyCobros");
		$('#alertSuccess').append(data);
		$('#alertSuccess').fadeToggle(2000);
		$('#alertSuccess').fadeToggle(2000);
	});


}