@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
		@include('categoria.create')
		<div class="box box-solid box-dark">
			<div class="box-header">
				<h2 class="box-title">Categorías</h2>
				<button class="btn btn-sm btn-success float-right" data-target="#newCategoria" data-toggle="modal"><i class="fa fa-plus-circle"></i> Nuevo</button>
			</div>

			<div class="box-body" style="padding-left: 5%; padding-right: 5%;">
				<table class="table table table-striped table-bordered dt-responsive nowrap" id="generalTable">
					<thead class="thead-dark">
						<tr>
							<th>Categoría</th>
							<th><i class="fa fa-wrench"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($categorias as $categoria)
						@include('categoria.delete')
							<tr>
								<td>{{ $categoria->name }}</td>
								<td>
									{{ link_to_route('categoria.show', $title = "", $parameters = [$categoria->id], $attributes = ["class"=>"btn fas fa-bars btn-primary btn-sm","title"=>"Subcategorias"]) }}
									<a href="/categoria/{{ $categoria->id }}/edit" class="btn btn-sm btn-info" title="Editar"><i class="fas fa-edit"></i></a>
									<button type="button" class="btn btn-sm btn-danger" title="Eliminar" data-toggle="modal" data-target="#deleteCategoria{{$categoria->id}}"><i class="fas fa-trash"></i></button>
									
									{!! Form::open(['route' => ['categoria.destroy', $categoria->id], 'method' => 'DELETE', 'id'=>'fDelete'.$categoria->id]) !!}
									{!! Form::close() !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
@endsection

@section('scripts')
<script src="/js/dataTableInit.js"></script>
@endsection