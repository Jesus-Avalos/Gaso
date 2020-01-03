@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
    {{Form::open(['route'=>'producto.store','method' => 'POST','onsubmit'=>'return validaIngs()','files'=>true])}}
        {{Form::token()}}
        <div class="box box-solid box-dark">
            <div class="box-header">
                <h3 class="box-title">Registrar Producto</h3>
            </div>

            <div class="box-body" style="padding-left: 10%; padding-right: 10%;">
                @include('producto.forms.form')
                <div style="float: right;">
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </div>
    {{Form::close()}}
@endsection