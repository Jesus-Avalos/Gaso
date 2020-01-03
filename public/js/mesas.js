function flimpiarMesa(id){
	$.get('/mesas/limpiarMesa/' + id, function(data){
		$("#contenido").load(location.href + " #contenido");
		$('.limpiarModal' + id).modal('hide');
	});
}