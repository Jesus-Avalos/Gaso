@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
    {{Form::model($articulo,['route' => ['inventario.update', $articulo->id], 'method' => 'PUT'])}}
        {{Form::token()}}
        <div class="box box-solid box-dark">
            <div class="box-header">
                <h3 class="box-title">Editar Artículo</h3>
            </div>

            <div class="box-body" style="padding-left: 10%; padding-right: 10%;">
                @include('inventario.forms.form')
                <div style="float: right;">
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
    {{Form::close()}}
@endsection
