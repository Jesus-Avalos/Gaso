@extends('layouts.app')

@section('main-content')
    <div class="container" style="margin-top: 2%">
        <div align="center">
            <h1>Detalles de la venta a crédito</h1>
        </div>
        @if(Session::has('status'))
            <div class="alert alert-success">
                {{ Session::get('status') }}
            </div>
        @endif
        @if($datos[0]->pagado != $datos[0]->total)
        {!! Form::open(['route'=>'credito.store']) !!}
            <div class="row">
                    {!! Form::hidden('venta_id', $venta->id) !!}
                    <div class="col-12 col-md-6 form-group">
                        <label>Agregar crédito</label>
                        {!! Form::number('total_pago', null, ['class'=>'form-control','required','max'=>$datos[0]->deuda,'min'=>1]) !!}
                    </div>
                    <div class="col-12 col-md-6 form-group text-center">
                        <label class="w-100"></label>
                        <button type="submit" class="btn btn-sm btn-primary mt-2">Agregar</button>
                    </div>
                </div>
        {!! Form::close() !!}
        @else
            <div class="alert alert-success">
                <strong>Venta saldada</strong>
            </div>
        @endif
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-black">
                        <tr>
                            <th>Crédito</th>
                            <th>Fecha</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($abonos as $abono)
                                <tr>
                                    <td>{{ $abono->id }}</td>
                                    <td>{{ $abono->created_at }}</td>
                                    <td>${{ $abono->total_pago }}</td>
                                </tr>
                            @endforeach
                            @if($datos[0]->pagado == null)
                                <tr>
                                    <td colspan="3"><h3>Sin registros</h3></td>
                                </tr>
                            @endif
                    </tbody>
                </table>
                <div class="col-12 col-md-5 offset-md-7">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Pagado: </td>
                                <td>$ {{ ($datos[0]->pagado == null) ? 0 : $datos[0]->pagado }}</td>
                            </tr>
                            <tr>
                                <td>Deuda: </td>
                                <td>$ {{ ($datos[0]->pagado == null) ? $datos[0]->total : $datos[0]->deuda}}</td>
                            </tr>
                            <tr>
                                <td><strong>Total venta:</strong></td>
                                <td>$ {{ $datos[0]->total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection