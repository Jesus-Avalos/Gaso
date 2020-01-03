@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
    <div class="box box-solid box-dark">
        <div class="box-header">
            <h3 class="box-title">Listado de Clientes</h3>
            {{ link_to('/cliente/create', $title = 'Agregar', $attributes = ['class' => 'btn btn-sm btn-success float-right']) }}
        </div>

        <div class="box-body" style="padding-left: 5%; padding-right: 5%;">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="generalTable" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Domicilio</th>
                        <th>Colonia</th>
                        <th>Telefono</th>
                        <th><i class="fa fa-wrench"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        @include('cliente.delete')
                        <tr>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->domicilio }}</td>
                            <td>{{ $cliente->colonia }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>
                                <a href="/cliente/detalle/{{ $cliente->id }}" class="btn btn-primary btn-sm"><i class="fas fa-bars"></i></a>
                                <a href="/cliente/{{ $cliente->id }}/edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                @if($cliente->id != 1)
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar{{ $cliente->id }}"><i class="fa fa-trash"></i></button>
                                @endif
                                
                                {!! Form::open(['route' => ['cliente.destroy', $cliente->id], 'method' => 'DELETE','id'=>'fDelete'.$cliente->id]) !!} 
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