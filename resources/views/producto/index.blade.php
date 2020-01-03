@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div id="contenidoMain">
		<div class="box box-solid box-dark">
			<div class="box-header">
				<h2 class="box-title">Listado de productos</h2>
				<a href="/producto/create" class="btn btn-sm btn-success float-right"><i class="fa fa-plus-circle"></i> Nuevo</a>
			</div>

			<div class="box-body" style="padding-left: 5%; padding-right: 5%;">
				<table class="table table table-striped table-bordered dt-responsive nowrap" id="generalTable">
					<thead class="thead-dark">
						<tr>
							<th>Nombre</th>
							<th>Categoria</th>
							<th>Subcategoria</th>
							<th>Stock</th>
							<th>Fecha de creación</th>
							<th><i class="fa fa-wrench"></i></th>
						</tr>
					</thead>
					<tbody>
						@php $cont = 0; @endphp
						@foreach($productos as $producto)
						@include('producto.delete')
							<tr>
								<td>{{ $producto->name }}</td>
								<td>{{ $producto->categoria }}</td>
								<td>{{ $producto->subcategoria }}</td>
								<td>{{ $stock[$cont] }}@php $cont++; @endphp</td>
								<td>{{ $producto->created_at }}</td>
								<td>
									<a class="btn btn-info btn-sm" href="/producto/{{ $producto->id }}/edit"><i class="fa fa-edit"></i></a>
									<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteProducto{{$producto->id}}">
										<i class="fas fa-trash"></i>
									</button>
									{!! Form::open(['route' => ['producto.destroy', $producto->id], 'method' => 'DELETE', 'id'=>'fDelete'.$producto->id]) !!}
									{!! Form::close() !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	{{ Html::script('js/dataTableInit.js') }}
@endsection