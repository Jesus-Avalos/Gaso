@extends('layouts.app')

@section('main-content')
<div class="row justify-content-center">
    <ventas-cortes-component></ventas-cortes-component>
    <compras-cortes-component></compras-cortes-component>
    <abonos-cortes-component></abonos-cortes-component>
</div>
@endsection