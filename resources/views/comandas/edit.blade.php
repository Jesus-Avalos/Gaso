@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	@include('modals.descuento')
	@include('modals.modal')
	<div class="row">
			<span id="readyUl"></span>

			<div class="col-12">
				{{Form::model($venta,['route' => ['comandas.update', $venta[0]->id], 'method' => 'PUT'])}}
					{{Form::token()}}
					{{Form::hidden('mesa_id',$mesa->id)}}
					@include('forms.datosVentaCP')

					<div class="box box-solid box-dark">
						<div class="box-header">
							<h2 class="box-title">Orden {{$mesa->name}}</h2>
							<button 
								type="button"
								class="btn btn-sm btn-success float-right"
								data-toggle="modal"
								data-target=".productosModal">
									Agregar <i class="fa fa-plus-circle"></i>
							</button>
						</div>
						<div class="box-body" style="padding: 0px;">

							{{Form::hidden('venta_id', $venta[0]->id)}}

							<ul class="list-group" id="listCarga">
								
							</ul>
						</div>
					</div>
				{{Form::close()}}
			</div>
		
	</div>
@endsection