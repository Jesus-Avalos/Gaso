function emptyCantidad(){
	var cantidad = $("input[name='cantidad']").val();

	if (cantidad == '' || cantidad == '0') {
		$("input[name='por_unidad']").val('');
		$("input[name='por_unidad']").attr('disabled','disabled');
	}else{
		$("input[name='por_unidad']").removeAttr('disabled');
	}
	emptyPorcionUnidad();
}

function emptyPorcionUnidad(){
	var por_unidad = $("input[name='por_unidad']").val();

	if (por_unidad == '' || por_unidad == '0') {
		$("input[name='precio_unidad']").val('');
		$("input[name='porciones']").val('');
		$("input[name='precio_unidad']").attr('disabled','disabled');
	}else{
		$("input[name='precio_unidad']").removeAttr('disabled');
		calculaPorciones();
	}
	emptyPrecioUnidad();
}

function emptyPrecioUnidad(){
	var precio_unidad = $("input[name='precio_unidad']").val();

	if (precio_unidad == '' || precio_unidad == '0') {
		$("input[name='precio_porcion']").val('');
	}else{
		calculaPrecioPorcion();
	}
}

function calculaPorciones(){
	var cantidad = parseInt($("input[name='cantidad']").val());
	var por_unidad = parseInt($("input[name='por_unidad']").val());
	var total = cantidad * por_unidad;

	$("input[name='porciones']").val(total);
}

function calculaPrecioPorcion(){
	var por_unidad = parseFloat($("input[name='por_unidad']").val()).toFixed(1);
	var precio_unidad = parseFloat($("input[name='precio_unidad']").val()).toFixed(1);
	var total = parseFloat(precio_unidad / por_unidad).toFixed(1);

	$("input[name='precio_porcion']").val(total);
}