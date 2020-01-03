// function descAuth(){
// 	var cant = $('input[name="desc"]').val();
// 	if (cant == '') {cant = 0};
// 	var parametros = {
//             "passadmin" : $('input[name="passadmin"]').val()
//     };
//     $('#descModal').modal('hide');
//     $('input[name="desc"]').val(0);
//     $('input[name="passadmin"]').val('');
//     $.ajax({
//             data:  parametros, //datos que se envian a traves de ajax
//             url:   '/descuento', //archivo que recibe la peticion
//             type:  'post', //método de envio
//             headers: {
// 		        'X-CSRF-TOKEN': $('input[name="_token"]').val()
// 		    },
//             success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
//                 if (response == 'Correcto') {
//                 	$('#descSpan').html(cant);
//                 	$('input[name="descuento"]').val(cant);
//                 }else{
//                 	alert('La contraseña es incorrecta!!!');
//                 }
//             }
//     });
// }

function getDesc(){
	var desc = $('input[name="descuento"]').val();
	$('input[name="desc"]').val(desc);
}

function descReal(){
	// if (descProductos > subProductos) {
	// 	$('input[name="descuento"]').val(subProductos);
	// }else{
	// 	var cant = $('input[name="desc"]').val();
	// 	if (cant == '') {cant = 0};
	// 	$('#descSpan').html(cant);
	// 	$('input[name="descuento"]').val(cant);
	// }

	descProductos = $('input[name="desc"]').val();
	fCalcularSubtotal();
}