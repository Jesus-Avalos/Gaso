@extends('layouts.app')

@section('main-content')
    <div class="box box-solid box-dark">
        <div class="box-header">
            <h2 class="box-title">Gastos</h2>
        </div>
        <div class="box-body">
            <div class="alert alert-success" style="display:none">

            </div>
            <gastos-component gastos="{{ $gastos }}" empresa="{{ $empresa }}"></gastos-component>
        </div>
    </div>
@endsection