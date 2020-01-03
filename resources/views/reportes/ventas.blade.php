@extends('layouts.app')

@section('main-content')
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3>Consulta ventas</h3>
				<reporte-component tipo="venta"></reporte-component>
			</div>
		</div>
	</div>
@endsection