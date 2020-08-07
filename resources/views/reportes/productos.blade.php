@extends('layouts.app')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Consulta productos más vendidos</h3>
                <productos-component tipo="producto"></productos-component>
            </div>
        </div>
    </div>
@endsection
