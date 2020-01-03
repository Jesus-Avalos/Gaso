@extends('layouts.app')

@section('main-content')
@include('mesas.create')
	<div id="contenido">
		<div class="box box-solid box-dark">
			<div class="box-header">
                <h2 class="box-title" style="font-size: 30px;">Gestionar mesas</h2>
            </div>
            <div class="box-body">
                <div class="alert alert-success" style="display: none"></div>
                <p class="text-danger"><strong>Nota: </strong><i>Las mesas deben estar disponibles para poder gestionarlas.</i></p>
                <mesas-component mesas="{{ $mesas }}"></mesas-component>
            </div>
        </div>
    </div>
@endsection