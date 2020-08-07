@extends('layouts.app')

@section('main-content')
    @php
        $deuda = $totalCargos[0]->totalCargos - $totalAbonos[0]->totalAbonos;
    @endphp
    <div class="box box-solid box-dark">
        <div class="box-header">
            <h3 class="box-title">Ventas y abonos del cliente</h3>
        </div>

        <div class="box-body row" style="padding-left: 5%; padding-right: 5%;">
            <div class="col-12 col-md-6 justify-content-end">
                @if ($deuda > 0)
                    {!! Form::open(['route'=>'credito.store']) !!}
                        <div class="row">
                            {!! Form::hidden('cliente_id', $cliente->id) !!}
                            <div class="col-12 col-md-6 form-group">
                                <label>Agregar abono</label>
                                {!! Form::number('total_pago', null, ['class'=>'form-control','required','max'=>$deuda,'min'=>1,'step'=>'any']) !!}
                            </div>
                            <div class="col-12 col-md-6 form-group text-center">
                                <label class="w-100"></label>
                                <button type="submit" class="btn btn-sm btn-primary mt-2">Agregar</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                @else
                    <div class="alert alert-success"><strong><h3>Saldo en 0</h3></strong></div>
                @endif
            </div>
            <div class="col-12 col-md-6">
                <table>
                    <tr>
                        <td>
                            <h3><strong>Total cargos:</strong> {{ $totalCargos[0]->totalCargos }}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3><strong>Total abonos:</strong> {{ $totalAbonos[0]->totalAbonos }}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3><strong>Saldo:</strong> {{ $deuda }}</h3>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-12">
                <table class="table table-striped table-bordered dt-responsive nowrap" id="creditosTable" style="width: 100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Folio</th>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Cargos</th>
                            <th>Abonos</th>
                            <th><i class="fas fa-wrench"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventas as $venta)
                            <tr>
                                <td> {{ $venta->id}} </td>
                                <td>{{ $venta->created_at }}</td>
                                <td>Venta</td>
                                <td>{{ $venta->total }}</td>
                                <td></td>
                                <td>
                                    {{ link_to_route('venta.show', $title = "", $parameters = [$venta->id], $attributes = ["class"=>"btn fa fa-bars btn-primary btn-sm","title"=>"Detalle"]) }}
                                </td>
                            </tr>
                        @endforeach
                        @foreach ($abonos as $abono)
                        <tr>
                            <td> {{ $abono->id}} </td>
                            <td>{{ $abono->created_at }}</td>
                            <td>Abono</td>
                            <td></td>
                            <td>{{ $abono->total_pago }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{ Html::script('js/ticket.js') }}
    <script>
        $('#creditosTable').DataTable({
            "order": [[ 1, "desc" ]],
            "autoWidth" : false,
            "paging" : false,
            "bInfo" : false,
            "pageLength": -1
        } );
    </script>
@endsection