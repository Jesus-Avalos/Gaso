@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
    {{Form::open(['url'=>'proovedor','method' => 'post'])}}
        {{Form::token()}}
        <div class="box box-solid box-dark">
            <div class="box-header">
                <h3 class="box-title">Registrar proovedor</h3>
            </div>

            <div class="box-body" style="padding-left: 10%; padding-right: 10%;">
                @include('proovedor.forms.form')
                <div class="float-right mt-2">
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </div>
    {{Form::close()}}
@endsection