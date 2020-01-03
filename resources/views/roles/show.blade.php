@extends('layouts.app')

@section('main-content')
<div class="container">
    <div class="box box-solid box-dark">
        <div class="box-header">
            <h3 class="box-title">Detalle Rol</h3>
        </div>

        <div class="box-body" style="padding-left: 5%; padding-right: 5%;">                                         
            <p><strong>Nombre</strong>     {{ $role->name }}</p>
            <p><strong>Slug</strong>       {{ $role->slug }}</p>
            <p><strong>Descripción</strong>  {{ $role->description }}</p>
        </div>
    </div>
</div>
@endsection