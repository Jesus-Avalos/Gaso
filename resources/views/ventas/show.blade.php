@extends('layouts.app')
@section('styles')
    <style>
        .dvClass > tr > td{
            padding: 1px;
        }
    </style>
@endsection
@section('main-content')
        <div align="center">
            <h1>Detalles de la venta</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <h1 class="text-center">Datos de la venta</h1>
                <table class="table table-bordered text-center">
                    <tbody class="dvClass">
                        <tr>
                            <td><b>Usuario:</b></td>
                            <td>{{ $venta->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Folio: </b></td>
                            <td>{{ $venta->id }}</td>
                        </tr> 
                        <tr>
                            <td><b>Fecha: </b></td>
                            <td>{{ $venta->created_at }}</td>
                        </tr>
                        @if($venta->tipo != 'Pedido')
                            <tr>
                                <td><b>Mesa: </b></td>
                                <td>{{ $mesa->name }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td><b>Tipo Venta: </b></td>
                            <td>{{ $venta->tipo }}</td>
                        </tr>
                        <tr>
                            <td><b>Tipo Pago: </b></td>
                            <td>{{ $venta->tipoPago }}</td>
                        </tr>
                        <tr>
                            <?php $tipo = ($venta->status == 'Exitosa') ? 'success' : 'danger' ?>
                            <td><b>Status: </b></td>
                            <td><small class="label label-{{$tipo}}">{{ $venta->status }}</small></td>
                        </tr>
                        <tr>
                            <td><b>Cliente: </b></td>
                            <td>{{ $cliente[0]->nombre }}</td>
                        </tr>
                        <tr>
                            <td><b>Domicilio: </b></td>
                            <td>{{ $cliente[0]->calle }}</td>
                        </tr>
                        <tr>
                            <td><b>Teléfono: </b></td>
                            <td>{{ $cliente[0]->tel }}</td>
                        </tr>
                    </tbody>
                </table>
                @if ($venta->tipoPago == 'Credito')
                    <h1 class="text-center">Abonos</h1>
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
                                @if(count($abonos)<1)
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
                @endif
            </div>
            <div class="col-12 col-md-6 table-responsive">
                <h1 class="text-center">Productos</h1>
                <table class="table table-bordered">
                    <thead class="bg-black">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                            <tr>
                                <td>{{ $producto->name }}</td>
                                <td>{{ $producto->cantidad }}</td>
                                <td>{{ $producto->precio_total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-12 col-md-5 offset-md-7">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Subtotal: </td>
                                <td>$ {{ $venta->subtotal }}</td>
                            </tr>
                            <tr>
                                <td>Descuento: </td>
                                <td>$ {{ $venta->descuento }}</td>
                            </tr>
                            <tr>
                                <td><strong>Total:</strong></td>
                                <td>$ {{ $venta->total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection