@extends('layouts.app')

@section('main-content')
    <div class="box box-solid box-dark">
        <div class="box-header">
            <h2 class="box-title">Ingresos extra</h2>
        </div>
        <div class="box-body">
            <div class="alert alert-success" style="display:none">

            </div>
            <ingresos-component ingresos="{{ $ingresos }}" empresa="{{ $empresa }}"></ingresos-component>
        </div>
    </div>
@endsection