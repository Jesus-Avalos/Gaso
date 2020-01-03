@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div id="contenido">
		<div class="box box-solid box-dark">
			<div class="box-header">
				<h2 class="box-title">Subcategorías</h2>
			</div>

			<div class="box-body">
				<table class="table">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Categoria</th>
							<th><i class="fa fa-wrench"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($subcategorias as $sub)
							<tr>

								<td>{{ $sub->name }}</td>
								<td>{{$sub->categoria}}</td>
								<td>
									@include('subcategoria.delete')
									<a type="button" href="/subcategoria/{{ $sub->id }}/edit" class="btn btn-sm btn-secondary" title="Editar"><i class="fas fa-edit"></i></a>
									<button type="button" class="btn btn-sm btn-danger" title="Eliminar" data-toggle="modal" data-target="#deleteSub{{$sub->id}}"><i class="fas fa-trash"></i></button>
									{!! Form::open(['route' => ['subcategoria.destroy', $sub->id], 'method' => 'DELETE', 'id'=>'fDelete'.$sub->id]) !!}
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
