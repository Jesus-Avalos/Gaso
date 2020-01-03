@extends('layouts.app')

@section('main-content')
    <div class="container">
        @if(Session::has('status'))
            <div class="alert alert-danger" id="alertSuccess" role="alert">
                {{Session::get('status')}}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cambiar password') }}</div>

                    <div class="card-body">
                        {{Form::model($user,['action' => ['UtilidadesController@changePass', $user->id], 'method' => 'PUT'])}}
                            {{ Form::token() }}

                            @include('users.forms.pass')

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Cambiar') }}
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