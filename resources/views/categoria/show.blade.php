@extends('layouts.app')

@section('htmlheader_title')
  {{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
  <div id="contenido">
    @include('subcategoria.create')
    <div class="box box-solid box-dark">
      <div class="box-header">
        <h2 class="box-title">Detalles {{ $cat->name }}</h2>
        <button class="btn btn-sm btn-success float-right" data-target="#newSub" data-toggle="modal"><i class="fa fa-plus-circle"></i> Nuevo</button>
      </div>

      <div class="box-body">

        @if(count($subcategorias) != 0)
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>Subcategoría</th>
                <th><i class="fa fa-wrench"></i></th>
              </tr>
            </thead>
            <tbody>
              @foreach($subcategorias as $sub)
                <tr>
                  <td>{{ $sub->name }}</td>
                  <td>
                    @include('subcategoria.delete')
                    {!! link_to_route('subcategoria.edit', $title = "", $parameters = [$sub->id], $attributes = ['class'=>'btn btn-sm btn-info fas fa-edit']) !!}
                    <button type="button" class="btn btn-sm btn-danger" title="Eliminar" data-toggle="modal" data-target="#deleteSub{{$sub->id}}"><i class="fas fa-trash"></i></button>
                    {!! Form::open(['route' => ['subcategoria.destroy', $sub->id], 'method' => 'DELETE', 'id'=>'fDelete'.$sub->id]) !!}
									  {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <div align="center"><h2><b>No hay subcategorias relacionadas a esta categoria</b></h2></div>
        @endif
        <div class="text-center"><a href="/categoria" class="btn btn-secondary">Regresar</a></div>
      </div>
    </div>
  </div>
@endsection
