@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
    <div class="box box-solid box-dark">
        <div class="box-header">
            <h3 class="box-title">Listado de Proovedores</h3>
            {{ link_to('/proovedor/create', $title = 'Agregar', $attributes = ['class' => 'btn btn-sm btn-success float-right']) }}
        </div>

        <div class="box-body" style="padding-left: 5%; padding-right: 5%;">
            @if (Session::has('status'))
                <div class="alert alert-success">{{ Session::get('status') }}</div>
            @endif
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
                    @foreach($proovedores as $proovedor)
                        @include('proovedor.delete')
                        <tr>
                            <td>{{ $proovedor->nombre }}</td>
                            <td>{{ $proovedor->domicilio }}</td>
                            <td>{{ $proovedor->colonia }}</td>
                            <td>{{ $proovedor->telefono }}</td>
                            <td>
                                {{-- <a href="/proovedor/detalle/{{ $proovedor->id }}" class="btn btn-primary btn-sm"><i class="fas fa-bars"></i></a> --}}
                                <a href="/proovedor/{{ $proovedor->id }}/edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminar{{ $proovedor->id }}"><i class="fa fa-trash"></i></button>
                                
                                {!! Form::open(['route' => ['proovedor.destroy', $proovedor->id], 'method' => 'DELETE','id'=>'fDelete'.$proovedor->id]) !!} 
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