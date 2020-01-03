@extends('layouts.app')

@section('main-content')
  <div class="box box-solid box-dark">
    <div class="box-header">
      <h3 class="box-title">Actualizar Categoría</h3>
    </div>
    <div class="box-body">
      {{Form::model($categoria,['route'=>['categoria.update', $categoria->id],'method'=>'PUT', 'files'=>true])}}
      {{Form::token()}}
      @include('categoria.forms.form')
      <div style="padding-left: 10%;" id="preview">
        <img src="{{ asset('storage/categorias/' . $categoria->url) }}" class="img-responsive" width="100" height="100">
      </div>
      <div class="float-right">
        <a href="/categoria" type="button" class="btn btn-secondary">Regresar</a>
        <button type="reset" name="button" class="btn btn-info">Reset</button>
        <button type="submit" name="button" class="btn btn-success">Actualizar</button>
      </div>
      {{Form::close()}}
    </div>
  </div>
@endsection