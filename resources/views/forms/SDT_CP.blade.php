<div class="row" style="margin: 2%; font-size: 18px;">
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