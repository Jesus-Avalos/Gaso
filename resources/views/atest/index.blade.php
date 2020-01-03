@extends('layouts.app')

@section('main-content')

    <comanda-component mesa-id="{{ $mesa->id or '' }}" mesa-nombre="{{ $mesa->name or '' }}" tipo="Comanda"></comanda-component>
@endsection

@section('scripts')
{{ Html::script('/js/prints.js') }}
{{ Html::script('/js/comandas.js') }}
{{ Html::script('/js/stock.js') }}
{{ Html::script('/js/clientes.js') }}
{{ Html::script('/js/descuento.js') }}
@endsection