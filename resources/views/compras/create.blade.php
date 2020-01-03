@extends('layouts.app')

@section('main-content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            {!! Form::open(['url'=>'compra']) !!}
                <compras-component proovedores="{{ $proovedores }}" inventario="{{ $inventario }}"></compras-component>
                {{-- @include('compras.forms.form') --}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection