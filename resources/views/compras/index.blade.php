@extends('layouts.app')

@section('main-content')
    <div class="box">
        <div class="box-header bg-dark">
            <h3 class="box-title">Compras</h3>
            <a class="btn btn-sm btn-success float-right" href="/compra/create"><i class="fas fa-plus-circle"></i> Nuevo</a>
        </div>
        <div class="box-body">
            <table class="table table-bordered" id="generalTable">
                <thead class="bg-dark">
                    <tr>
                        <th>Folio</th>
                        <th>Proovedor</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th><i class="fas fa-wrench"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compras as $compra)
                        <tr>
                            @include('compras.cancelar')
                            <td>{{ $compra->id }}</td>
                            <td>{{ $compra->nombre }}</td>
                            <td>${{ $compra->total }}</td>
                            <td>{{ $compra->created_at }}</td>
                            <td>
                                <a class="btn btn-sm btn-info" href="/compra/{{ $compra->id }}"><i class="fas fa-bars"></i></a>
                                <button class="btn btn-sm btn-danger" data-toggle='modal' data-target="#cancelar{{ $compra->id }}"><i class="fas fa-trash"></i></button>
                                {!! Form::open(['action' => ['CompraController@destroy', $compra->id], 'method' => 'DELETE','id'=>'fDelete'.$compra->id]) !!} 
                                {!! Form::close() !!}                         
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    {{ Html::script('js/dataTableInit.js') }}
@endsection