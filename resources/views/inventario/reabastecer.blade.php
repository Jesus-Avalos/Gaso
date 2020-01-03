@extends('layouts.app')

@section('main-content')
    <div class="box box-solid box-dark">
        <div class="box-header">
            <h2 class="box-title">Reabastecer</h2>
        </div>
		<div class="alert alert-success" id="alertSuccess" role="alert" style="display: none;"></div>
        <reabastecer-component></reabastecer-component>
    </div>
@endsection