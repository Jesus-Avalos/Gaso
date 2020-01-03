@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	@include('modals.descuento')
	@include('modals.modal')
	<div class="row">		
			<div class="col-12">
				{{Form::open(['route'=>'pedido.store', 'method' =>'POST'])}}
					{{Form::hidden('tipo','Pedido')}}
					{{Form::hidden('status','Pendiente')}}
				@include('forms.datosVentaCP')

				<div class="box box-solid box-dark">
					<div class="box-header">
						<h2 class="box-title">Orden</h2>
						<button 
							type="button"
							class="btn btn-sm btn-success float-right"
							data-toggle="modal"
							data-target=".productosModal">
								Agregar <i class="fa fa-plus-circle"></i>
						</button>
					</div>
					<div class="box-body" style="padding: 0px;">
						<ul class="list-group" id="listCarga">
							
						</ul>
					</div>
				</div>
			</div>
		{{Form::close()}}
	</div>
@endsection

@section('scripts')
{{ Html::script('/js/prints.js') }}
{{ Html::script('/js/comandas.js') }}
{{ Html::script('/js/stock.js') }}
{{ Html::script('/js/clientes.js') }}
{{ Html::script('/js/descuento.js') }}
@endsection