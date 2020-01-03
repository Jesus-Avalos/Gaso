@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
    {{Form::model($proovedor,['route' => ['proovedor.update', $proovedor->id], 'method' => 'PUT'])}}
        {{Form::token()}}
        <div class="box box-solid box-dark">
            <div class="box-header">
                <h3 class="box-title">Editar proovedor</h3>
            </div>

            <div class="box-body" style="padding-left: 10%; padding-right: 10%;">
                @include('proovedor.forms.form')
                <div class="float-right mt-2">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
    {{Form::close()}}
@endsection
