<li class="list-group-item" id="item'+cont+'">
	<div class="row">
		<div class="col-xs-10">
			<h4><b>Producto</b></h4>
		</div>
		<div class="col-xs-2">
			<button class="btn btn-danger" type="button">
				<i class="fas fa-trash"></i>
			</button>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-9">
			Cantidad:
			<input type="number" style="width: 50px">
			<button type="button" class="btn btn-primary btn-social"><i class="fa fa-edit"></i>Ingredientes</button>
		</div>
		<div class=" col-xs-3">
			<h4>$ Precio</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<select class="optionSelect" multiple style="width: 300px;">
				<option value="1" selected>Ing 1</option>
				<option value="2" selected>Ing 2</option>
				<option value="3">Ing 3</option>
			</select>
		</div>
	</div>
</li>
<li class="list-group-item" id="item'+cont+'">
	<h4 style="margin:0px; margin-top: 10px; float: left;">
		<b id="prod">Producto</b><b> Tipo</b>
	</h4>
	<input type="hidden" name="producto[]" value="'+producto+' '+tipo+'">
	<a class="btn btn-danger" style="float: right;">
		<i class="glyphicon glyphicon-trash"></i>
	</a>
	<br><br>
	<p style="margin: 0px; margin-bottom: 5px;" id="ingredientes">Detalles</p>
	<textarea name="detalles[]" rows="10" cols="50" style="display:none;">Detalles</textarea>
	Cantidad: 
	<input type="number" id="cantidad'+cont+'" value="1" name="cantidad[]" style="width: 50px;" class="text-center" readonly>
	&nbsp;
	<a class="btn btn-primary">
		<i class="glyphicon glyphicon-plus"></i>
	</a>
	<h4 style="float: right;" id="sub'+cont+'">
		$
		<span id="st'+cont+'">Precio</span>
		<input type="hidden" id="prec'+cont+'" value="'+preTotal+'">
		.00
	</h4>
	<input type="hidden" value="'+preTotal+'" name="precioVenta[]" id="precio'+cont+'">
	<br>
	<select class="optionSelect" multiple style="width: 300px;">
		<option value="1" selected>Ing 1</option>
		<option value="2" selected>Ing 2</option>
		<option value="3">Ing 3</option>
	</select>
</li>