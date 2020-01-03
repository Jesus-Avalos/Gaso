@extends('layouts.app')

@section('main-content')
<div class="container">
    <div class="box box-solid box-dark">
        <div class="box-header">
            <h3 class="box-title">Crear Rol</h3>
        </div>

        <div class="box-body" style="padding-left: 5%; padding-right: 5%;">
            {{ Form::open(['route' => 'roles.store']) }}         

                @include('roles.partials.form')
                <button class="btn btn-sm btn-primary float-right"><i class="fas fa-check"></i> Guardar</button>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection