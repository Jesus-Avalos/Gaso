@extends('layouts.app')

@section('main-content')
    <div class="container" style="margin-top: 2%">
        <div align="center">
            <h1>Detalles de la compra</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-5">
                <table class="table table-bordered">
                    <tbody class="dvClass">
                        <tr>
                            <td><b>Usuario:</b></td>
                            <td>{{ $compra->name }}</td>
                        </tr>
                        <tr>
                            <td><b>Folio: </b></td>
                            <td>{{ $compra->id }}</td>
                        </tr>
                        <tr>
                            <?php $tipo = ($compra->status == 'Exitosa') ? 'success' : 'danger' ?>
                            <td><b>Status: </b></td>
                            <td><small class="label label-{{$tipo}}">{{ $compra->status }}</small></td>
                        </tr>
                        <tr>
                            <td><b>Proovedor: </b></td>
                            <td>{{ $proovedor->nombre }}</td>
                        </tr>
                        <tr>
                            <td><b>Domicilio: </b></td>
                            <td>{{ $proovedor->domicilio }}</td>
                        </tr>
                        <tr>
                            <td><b>Teléfono: </b></td>
                            <td>{{ $proovedor->telefono }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-md-7 table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-black">
                        <tr>
                            <th>Artículo</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articulos as $articulo)
                            <tr>
                                <td>{{ $articulo->nombre }}</td>
                                <td>{{ $articulo->precio_unidad }}</td>
                                <td>{{ $articulo->cantidad }}</td>
                                <td>{{ $articulo->subtotal }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-12 col-md-5 offset-md-7">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Total:</strong></td>
                                <td>$ {{ $compra->total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection