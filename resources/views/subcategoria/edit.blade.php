@extends('layouts.app')

@section('main-content')
<div class="box box-solid box-dark">
  <div class="box-header">
    <h3 class="box-title">Actualizar Subcategoría</h3>
  </div>
  <div class="box-body">
    {{Form::model($sub,['route'=>['subcategoria.update', $sub->id],'method'=>'PUT', 'files'=>true])}}
    {{Form::token()}}
    @include('subcategoria.forms.form')
    <div style="padding-left: 10%;" id="preview">
      <img src="{{ asset('storage/subcategorias/' . $sub->url) }}" class="img-responsive" width="150" height="150">
    </div>
    <div class="float-right">
      <a href="categoria/{{ $sub->categoria_id }}" type="button" class="btn btn-secondary">Regresar</a>
      <button type="reset" name="button" class="btn btn-info">Reset</button>
      <button type="submit" name="button" class="btn btn-success">Actualizar</button>
    </div>
    {{Form::close()}}
  </div>
</div>
@endsection