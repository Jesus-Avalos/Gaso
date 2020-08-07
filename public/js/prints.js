async function fgetCategorias(){
	await axios.get('/getCategorias').then(response => {
		$("#title01").text('Categorías');
	    fprintSubcategorias(response.data,'Categorias');
	});
}

async function selectCategorias(id){
	await axios.get(`/selcategorias/${id}`).then(response => {
	    $("#title01").html(`<a href="#" onclick="fgetCategorias()">Categorías</a>
	    						<i class="fa fa-arrow-right"></i>
	    					Subcategorías`);
	    fprintSubcategorias(response.data,'Subcategorias');
	});
}

function fprintSubcategorias(data,tipo){
	$("#content01").empty();
    var cadena = '';
    for (var i = 0; i < data.length; i++) {
		cadena +=   `<div class="col-6 col-md-3">
						<div class="box box-primary box-solid">
							<div class="box-body" style="padding: 0px;">
								<a href="#" onclick="select${tipo}(${data[i].id})">
									<img src="${APP_URL}/storage/${tipo}/${data[i].url}" style="width: 100%; height: 100px;">
								</a>
							</div>
							<div class="box-header" align="center" style="padding: 0px;">
								${data[i].name}
							</div>
						</div>
					</div>`;
	}
    $("#content01").append(cadena);
}

async function selectSubcategorias(id){
	await axios.get(`/selsubcategorias/${id}`).then(response => {
	    $("#title01").html('<a href="#" onclick="fgetCategorias()">Categorías</a>' + 
	    				   ' <i class="fa fa-arrow-right"></i> ' +
	    				   '<a href="#" onclick="selectCategorias('+  response.data[1] +')">Subcategorías</a>' + 
	    				   ' <i class="fa fa-arrow-right"></i> ' +
	    				   'Productos');
	    fprintProductos(response.data[0]);
	});
}

async function fprintProductos(data){
	$("#content01").empty();
    var cadena = '';
    for (var i = 0; i < data.length; i++) {
		var stock = await fcalculaStock(data[i].id);
		if(stock > 0){
			cadena +=   `<div class="col-6 col-md-3">
							<div class="box box-primary box-solid">
								<div class="box-body" style="padding: 0px;">
									<a href="#" onclick="addProducto(${data[i].id},${stock})">
										<img src="${APP_URL}/storage/productos/${data[i].url}" style="width: 100%; height: 100px;">
									</a>
								</div>
								<div class="box-header" align="center" style="padding: 0px;">
									${data[i].name}
								</div>
							</div>
						</div>`;
		}
	}
    $("#content01").append(cadena);
}

async function fcalculaStock(id){
	var stock = await axios.get('/getStock/'+id).then(response => response.data - fcalculaCantArray(id));
	return stock;
}