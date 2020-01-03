@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
    <div class="box box-solid box-dark">
        <div class="box-header">
            <h3 class="box-title">Artículos</h3>
            <a href="/inventario/create" class="btn btn-sm btn-success float-right ml-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
            <a href="/inventario/reabastecer" class="btn btn-sm btn-warning float-right"><i class="fas fa-plus"></i> Reabastecer</a>
        </div>

        <div class="box-body" style="padding-left: 5%; padding-right: 5%;">
            @if(Session::has('status'))
                <div class="alert alert-success">
                    {{ Session::get('status') }}
                </div>
            @endif
            <table class="table table table-striped table-bordered dt-responsive nowrap" id="generalTable">
                <thead class="thead-dark">
                    <tr>
                        <th>NOMBRE</th>
                        <th>TIPO</th>
                        <th>CANTIDAD</th>
                        <th>$/UNIDAD</th>
                        <th>PORCIONES</th>
                        <th>STOCK MINIMO</th>
                        <th>OPERACION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articulos as $articulo)
                    @include('inventario.delete')
                        <tr>
                            <td>{{ $articulo->nombre }}</td>
                            <td>{{ $articulo->tipo }}</td>
                            <td class="text-center">{{ $articulo->cantidad }}</td>
                            <td class="text-center">{{ $articulo->precio_unidad }}</td>
                            <td class="text-center">{{ $articulo->porciones }}</td>
                            <td class="text-center">{{ $articulo->stock_min }}</td>
                            <td>
                                {{ link_to_route('inventario.edit', $title = "", $parameters = $articulo->id, $attributes = ["class"=>"btn fas fa-edit btn-info btn-sm"]) }}
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar{{ $articulo->id }}"><i class="fas fa-trash"></i></button>
                                {!! Form::open(['route' => ['inventario.destroy', $articulo->id], 'method' => 'DELETE', 'id'=>'fDelete'.$articulo->id]) !!}
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
    {{ Html::script('js/dataTableInit.js') }}
@endsection