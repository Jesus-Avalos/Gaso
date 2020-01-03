@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	@if (Session::has('message'))
        <div class="alert alert-danger" id="alertSuccess" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    {{-- {{ $validator }} --}}
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar Usuario') }}</div>

                    <div class="card-body">
                        {{Form::model($user,['route' => ['user.update', $user->id], 'method' => 'PUT', 'files'=>true])}}
                            {{ Form::token() }}

                            @include('users.forms.form')

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Actualizar') }}
                                    </button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection