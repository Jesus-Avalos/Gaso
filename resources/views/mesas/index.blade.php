@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
@include('mesas.create')
	<div id="contenido">
		<div class="box box-solid box-dark">
			<div class="box-header">
				<h2 class="box-title">Mesas</h2>
				@can('mesas.create')
					<button class="btn btn-sm btn-success float-right" data-target="#MesasCreate" data-toggle="modal"><i class="fas fa-plus-circle"></i> Nuevo</button>
					<a class="btn btn-sm btn-warning float-right mr-2" type="button" href="/mesas/gestionar"><i class="fas fa-bars"></i> Administrar</a>
				@endcan
			</div>

			<div class="box-body">
				
				<div class="row text-center">
					@foreach($mesas as $mesa)
						@php
							switch ($mesa->status) {
								case 1: $color = 'success'; $estado = 'Disponible'; $f = 'show';break;
								case 0: $color = 'danger'; $estado = 'Ocupada'; $f = 'edit';break;
								case 2: $color = 'warning'; $estado = 'Sucia'; break;
							}
						@endphp
						<div class="col-6 col-md-3">
								<div class="box box-{{ $color }} box-solid">
								<div class="box-body bg-{{ $color }}">
									@if($mesa->status != 2)
										<a href="{{ route('comandas.'.$f, $mesa->id) }}">
											<img src="{{ asset('/storage/mesa.png') }}" class="img-fluid" alt="Responsive image">
										</a>
									@else
										@include('mesas.forms.modal')
										<a href="#" data-toggle="modal" data-target=".limpiarModal{{ $mesa->id }}">
											<img src="{{ asset('/storage/mesa.png') }}" class="img-fluid" alt="Responsive image">
										</a>
									@endif
								</div>
								<div class="box-header" align="center" style="padding: 0px;">
									<a>
										<div style="padding: 2%;">
											{{ $estado }} {{ $mesa->name }}
										</div>
									</a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
				
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	{{ Html::script('js/mesas.js') }}
@endsection