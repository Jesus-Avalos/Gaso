@extends('layouts.app')

@section('main-content')
<div class="container">
        <div class="box box-solid box-dark">
        
            <div class="box-header">
                <h3 class="box-title">Editar Rol</h3>
                
            </div>

            <div class="box-body" style="padding-left: 5%; padding-right: 5%;"> 
            {!! Form::model($role, ['route' => ['roles.update', $role->id],'method' => 'PUT']) !!}    
                @include('roles.partials.form')

                <button class="btn btn-sm btn-success float-right"><i class="fas fa-check"></i> Actualizar</button>
            {!! Form::close() !!}
            </div>
    </div>
</div>
@endsection