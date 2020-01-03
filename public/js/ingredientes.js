// import Axios from "axios";

var total = 0;
existentes = [];

function agregaIng(){
	var id = $('#ing_select').val();

	if (id != "") {
		var nombre = $('#ing_select option:selected').text();
		var id = parseInt($('#ing_select').val());
		var precio = $('.seling').val();
		var porciones = $('.porciones').val();
		var precioTotal = parseFloat((precio * porciones).toFixed(1));
		var index = existentes.indexOf(id);

		if(existentes.length == 0) $('#ings').empty();

		if(index > -1){
			alert('Ya has agregado ese ingrediente!');
		}else {

			var fila = 	'<tr id="fila'+id+'" class="ingsList">' + 
							'<input type="hidden" name="ingredientes_id[]" value="'+id+'">' + 
							'<input type="hidden" id="precioUnit'+id+'" value="'+precio+'">' +
							'<td>'+nombre+'</td>' +
							'<td>' +
								'<input type="number" min="1" name="porciones[]" value="'+porciones+'" id="porcionInp'+id+'" class="text-center" onkeyup="validarOne(this); chgPorcion('+id+')">' +
							'</td>' +
							'<td>' +
								'<input type="hidden" id="precioInp'+id+'" name="precio[]" value="'+precioTotal+'">' +
								'<span id="precioTotal'+id+'">'+precioTotal+'</span>' +
							'</td>' +
							'<td><button class="btn btn-sm btn-danger" type="button" onclick="eliminarFilaIng('+id+');"><i class="fas fa-trash"></i></button></td>' +
						'</tr>';
			total += precioTotal;
			existentes.push(id);

			$('#ings').append(fila);

			totalProduccion();
		}
	}else{
		alert('Selecciona un ingrediente!');
	}
}

function validaIngs(){
	var ings = document.getElementsByClassName('ingsList');
	if(ings.length){
		return true
	}else{
		$('.alertIngs').fadeIn();
		$('html,body').scrollTop(0);
		return false;
	}
}

function eliminarFilaIng(num){
	var temp = parseFloat($('#precioTotal'+num).text()).toFixed(1);
	existentes.splice(existentes.indexOf(num), 1);
	if(existentes.length == 0) {
		$('#ings').empty();
		$('#ings').append('<tr><td colspan="4"><h3>Agrega al menos un ingrediente</h3></td></tr>');
	}
	$('#fila'+num).remove();
	total -= temp;
	totalProduccion();
}

function chgPorcion(num){
	var temp = parseFloat($('#precioTotal'+num).text()).toFixed(1);
	var temp1 = parseFloat($('#precioUnit'+num).val()).toFixed(1);
	var temp2 = parseInt($('#porcionInp'+num).val());
	var opeTemp = parseFloat((temp1 * temp2).toFixed(1));
	total -= temp;
	total += opeTemp;
	$('#precioTotal'+num).text(opeTemp);
	$('#precioInp'+num).val(opeTemp);
	totalProduccion();
}

function totalProduccion(){
	$('.produccion').val(total.toFixed(2));
}

function chgIng(){
	var id = $('#ing_select').val();
	$.ajax({
		method: "GET",
		url: "/ingSelect/" + id
	})
	.done(function( msg ) {
		$('.seling').val(msg);
	});
}
