@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
    {{Form::open(['url'=>'inventario','method' => 'post'])}}
        {{Form::token()}}
        <div class="box box-solid box-dark">
            <div class="box-header">
                <h3 class="box-title">Registrar Artículo</h3>
            </div>

            <div class="box-body" style="padding-left: 10%; padding-right: 10%;">
                @include('inventario.forms.form')
                <div style="float: right;">
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </div>
    {{Form::close()}}
@endsection
