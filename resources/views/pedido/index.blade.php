@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div id="contenido">
		@include('mesas.create')
		<div class="box box-solid box-dark">
			<div class="box-header">
				<h2 class="box-title">Pedidos</h2>
				@can('pedidos.edit')
				<a href="pedido/create" class="btn btn-sm btn-success float-right"><i class="fa fa-plus-circle"></i> Nuevo</a>
				@endcan
			</div>

			<div class="box-body">
				@if (Session::has('message'))
					<hr />
					<div class='text-success'>
						{{Session::get('message')}}
					</div>
					<hr />
				@endif
				<div class="table-responsive">
					<table class="table table-bordered dt-responsive" id="pedidosTable">
						<thead class="thead-dark">
							<tr>
								<th><i class="fa fa-wrench"></i></th>
								<th>Folio</th>
								<th>Usuario</th>
								<th>Cliente</th>
								<th>Domicilio</th>
								<th>Referencia</th>
								<th>Teléfono</th>
								<th>Status</th>
								<th>Fecha de Registro</th>
							</tr>
						</thead>
						<tbody>
							@foreach($ventas as $venta)
								@include('pedido.modals.cancelar')
								<tr>
									<td>
										{!! link_to_route('pedido.edit', $title = "", $parameters = [$venta->id], $attributes = ['class'=>'btn btn-sm btn-info fas fa-edit']) !!}
									</td>
									<td>{{ $venta->id }}</td>
									<td>{{ $venta->name }}</td>
									<td>{{ $venta->nombre }}</td>
									<td>{{ $venta->domicilio }}</td>
									<td>{{ $venta->referencia }}</td>
									<td>{{ $venta->telefono }}</td>
									<td><small class="label label-warning">{{$venta->status}}</small></td>
									<td>{{$venta->created_at}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$('#pedidosTable').DataTable({
			"order": [[ 1, "desc" ]],
			"autoWidth" : false,
			"paging" : false,
			"bInfo" : false,
			"pageLength": -1
		} );
	</script>
@endsection