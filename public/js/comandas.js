contProductos = 1;
subArray = [];
subProductos = 0;
descProductos = 0;
totalProductos = 0;
cantArray = [];
swIng = false;

$(document).ready(function() {
	fgetCategorias();
	if ( $('#readyUl').length ){
		var mesa_id = $('input[name="mesa_id"]').val();
		axios.get(`/comandas/getVentaComanda/${mesa_id}`).then(response => {
			var datos = response.data;
			descProductos = datos[0][0].descuento;
			fprintComanda(datos[1],datos[2],datos[3]);
		});
	};
	if ( $('#pedidoDiv').length ){
		var venta_id = $('input[name="venta_id"]').val();
		axios.get(`/pedido/getVentaPedido/${venta_id}`).then(response => {
			var datos = response.data;
			descProductos = datos[0][0].descuento;
			fprintComanda(datos[1],datos[2],datos[3]);
		});
	};
	fcalcularTotal();
});

function showIng(item){
	var show = (swIng) ? "none" : "block";
	swIng = (swIng) ? false : true;
	$("#divSelectIng" + item).css("display",show);
}

function addProducto(id, stock){
	if(stock > 0){
		$.get('/getProducto/' + id, function(data){
			$("#listCarga").append(`
				<li class="list-group-item" id="item${contProductos}">
					<input type="hidden" value="${contProductos}" name="item[]">
					<input type="hidden" value="${data[0].id}" name="producto_id[${contProductos}]">
					<div class="row">
						<div class="col-10">
							<h4><b>${data[0].name}</b></h4>
						</div>
						<div class="col-2 text-right">
							<button class="btn btn-danger btn-sm" type="button" onclick="borrarProducto(${contProductos},${data[0].id})">
								<i class="fas fa-trash"></i>
							</button>
						</div>
					</div>
					<div class="row" style="margin-bottom: 3px;">
						<div class="col-8">
							Cantidad:
							<input type="number" name="cantidad[${contProductos}]" onkeypress="return event.keyCode!=13" 
							style="width: 50px; text-align: center;" 
							value="1" min="1" max="${stock}" id="cantidad${contProductos}" 
							oninput="chgCantidad(${contProductos},${data[0].precio_venta},${data[0].id},${stock},'add')"> 
							<button type="button" class="btn btn-primary btn-sm" onclick="showIng(${contProductos})"><i class="fas fa-edit"></i></button>
							<button type="button" class="btn btn-danger btn-sm" 
								onclick="chgCantidad(${contProductos},${data[0].precio_venta},${data[0].id},${stock},'less')"><i class="fas fa-minus"></i></button>
							<button type="button" class="btn btn-success btn-sm" 
								onclick="chgCantidad(${contProductos},${data[0].precio_venta},${data[0].id},${stock},'plus')"><i class="fas fa-plus"></i></button>
						</div>
						<div class="col-4 text-right">
							<h2 style="margin: 0px;">$<span id="precioItem${contProductos}">${data[0].precio_venta}</span></h2>
							<input type="hidden" name="precio_total[${contProductos}]" value="${data[0].precio_venta}">
						</div>
					</div>
					<div class="row justify-content-left" id="divSelectIng${contProductos}" style="display:none;">
						<div class="col-12 col-md-5">
							<select class="selectpicker form-control float-left" name="ingSelected[${contProductos}][]" id="selectCmd${contProductos}" multiple style="width: 300px;">
								${data[1]}
							</select>
						</div>
					</div>
				</li>
			`);

			faddArrayCant(data[0].id, contProductos, 1);

			subArray[contProductos] = data[0].precio_venta;

			fCalcularSubtotal();

			contProductos++;

			$('.selectpicker').selectpicker('refresh');
		});
	}else{
		alert('Producto insuficiente!!');
	}
}

// onfocus="chgMaxCant('+data[0].id+',this.value,'+contProductos+')"

async function fprintComanda(dataProd, ings, selected){

	for(var i = 0; i < dataProd.length; i++){
		var producto_id = dataProd[i].producto_id;
		var stock = await fcalculaStock(producto_id);
		var producto_name = dataProd[i].name;
		var subcat = dataProd[i].subcategoria_id;
		var producto_precio = dataProd[i].precio_total;
		var producto_cantidad = dataProd[i].cantidad;
		var producto_venta = dataProd[i].precio_venta;

		var options = '';
		$.each(ings[i], function( index, value ) {
			if(0 <= $.inArray(index,selected[i])){
				options += `<option value="${index}" selected>${value}</option>`;
			}else{
				options += `<option value="${index}">${value}</option>`;
			}
		});

		$("#listCarga").append(`
			<li class="list-group-item" id="item${contProductos}">
				<input type="hidden" value="${contProductos}" name="item[]">
				<input type="hidden" value="${producto_id}" name="producto_id[${contProductos}]">
				<div class="row">
					<div class="col">
						<h4><b>${producto_name}</b></h4>
					</div>
					<div class="col text-right">
						<button class="btn btn-danger btn-sm" type="button" onclick="borrarProducto(${contProductos},${producto_id},${subcat})">
							<i class="fa fa-trash"></i>
						</button>
					</div>
				</div>
				<div class="row" style="margin-bottom: 3px;">
					<div class="col-8">
						Cantidad:
						<input type="number" name="cantidad[${contProductos}]" style="width: 50px; text-align: center;" onkeypress="return event.keyCode!=13" 
							value="${producto_cantidad}" min="1" max="${stock}" 
							id="cantidad${contProductos}" 
							oninput="chgCantidad(${contProductos},${producto_venta},${producto_id},${stock},'add')"> 
						<button type="button" class="btn btn-primary btn-sm" onclick="showIng(${contProductos})"><i class="fa fa-edit"></i></button>
						<button type="button" class="btn btn-danger btn-sm" 
							onclick="chgCantidad(${contProductos},${producto_venta},${producto_id},${stock},'less')"><i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-success btn-sm" 
							onclick="chgCantidad(${contProductos},${producto_venta},${producto_id},${stock},'plus')"><i class="fas fa-plus"></i></button>
					</div>
					<div class="col-4 text-right">
						<h2 style="margin: 0px;">$<span id="precioItem${contProductos}">${producto_precio}</span></h2>
						<input type="hidden" name="precio_total[${contProductos}]" value="${producto_precio}">
					</div>
				</div>
				<div class="row" id="divSelectIng${contProductos}" style="display:none;">
					<div class="col-12 col-md-5">
						<select class="selectpicker form-control float-left" name="ingSelected[${contProductos}][]" id="selectCmd${contProductos}" multiple style="width: 300px;">
							${options}
						</select>
					</div>
				</div>
			</li>
		`);

		faddArrayCant(producto_id, contProductos, producto_cantidad);
		subArray[contProductos] = producto_precio;
		fCalcularSubtotal();

		contProductos++;

		$('.selectpicker').selectpicker('refresh');

	}
}

function faddArrayCant(id, item, cant){

	if('id'+id in cantArray){
		cantArray['id'+id]['item'+item] = cant;
	}else{
		cantArray['id'+id] = [];
		cantArray['id'+id]['item'+item] = cant;
	}
}

function chgCantidad(item,precio,id,stock,tipo){
	var cant = parseInt($('#cantidad'+item).val());
	if(cant == ''){cant = 1;}
	if(cant < stock){
		if(tipo == 'plus'){
			cant++;
			$('#cantidad'+item).val(cant);
		}else if(tipo == 'less'){
			if(cant > 1){
				cant--;
				$('#cantidad'+item).val(cant);
			}
		}
		res = parseInt(cant) * precio;
		subArray[item] = res; 
		fCalcularSubtotal();

		cantArray['id'+id]['item'+item] = cant;

		$('#precioItem' + item).html(res);
		$('input[name="precio_total['+item+']"]').val(res);
	}else{
		$('#cantidad'+item).val(stock);
	}
}

function borrarProducto(item, id){
	subArray[item] = 0;
	delete cantArray['id'+id]['item'+item];
	fCalcularSubtotal();
	$('#item'+item).remove();
}

function fcalculaCantArray(id){

	if('id'+id in cantArray){
		var sum = 0;
		for(var item in cantArray['id'+id]) {
		  sum += parseInt(cantArray['id'+id][item]);
		}
		return sum;
	}else{
		return 0;
	}
}

function fcalcularTotal(){
	totalProductos = subProductos - descProductos;
	if(totalProductos == 0){
		$("#submit").css("display","none");
	}else{
		$("#submit").css("display","block");
	}
	fprinTotales();
}

function fCalcularSubtotal(){
	subProductos = 0;
	for (var res in subArray) {
		subProductos += subArray[res];
	};

	fDescuento();
	fcalcularTotal();
}

function fDescuento(){
	$('input[name="desc"]').attr("max",subProductos);
	if(descProductos > subProductos){
		descProductos = subProductos;
	}
	$('input[name="descuento"]').val(descProductos);
	$('#descSpan').html(descProductos);

	$('#descModal').modal('hide');
}

function fprinTotales(){
	if (subProductos != 0) {$("#GuardarBoton").css("display","block");}else{$("#GuardarBoton").css("display","none");};
	$('#subSpan').html(subProductos);
	$('input[name="subtotal"]').val(subProductos);
	$('#totalSpan').html(totalProductos);
	$('input[name="total"]').val(totalProductos);
}

// function activar(item){
// 	$('#editarCom' + item).click();
// }

// function editComanda(id, item, precio, cant){
// 	faddArrayCant(id, item, cant);

// 	subArray[item] = precio;

// 	fCalcularSubtotal();

// 	contProductos++;
// }