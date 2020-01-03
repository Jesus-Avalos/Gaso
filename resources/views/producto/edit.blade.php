@extends('layouts.app')
@section('main-content')
<div class="box box-solid box-dark">
  <div class="box-header">
    <h3 class="box-title">Actualizar Producto</h3>
  </div>
  <div class="box-body" style="padding-left: 10%; padding-right: 10%;">
    {{Form::model($producto,['route'=>['producto.update', $producto->id],'method'=>'PUT','onsubmit'=>'return validaIngs()','files'=>true])}}
    {{Form::token()}}
    @include('producto.forms.form')
    <div class="float-right">
      <button type="reset" name="button" class="btn btn-info">Reset</button>
      <button type="submit" name="button" class="btn btn-primary">Actualizar</button>
    </div>
    {{Form::close()}}
  </div>
</div>
@endsection