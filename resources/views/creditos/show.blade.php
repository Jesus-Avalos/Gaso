@extends('layouts.app')

@section('main-content')
    <div class="box box-solid box-dark">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>

        <div class="box-body" style="padding-left: 5%; padding-right: 5%;">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="creditosTable" style="width: 100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Tipo</th>
                        <th>Folio</th>
                        <th>Status</th>
                        <th>Deuda</th>
                        <th>Total</th>
                        <th><i class="fa fa-wrench"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                        <tr>
                            <td>{{ $venta->tipo}}</td>
                            <td> {{ $venta->id}} </td>
                            <td><small class="label label-warning">{{$venta->status}}</small></td>
                            <td>{{ ($venta->pagado == null) ? $venta->total : $venta->deuda }}</td>
                            <td>{{ $venta->total }}</td>
                            <td>
                                {{ link_to_route('credito.show', $title = "", $parameters = [$venta->id], $attributes = ["class"=>"btn fa fa-dollar-sign btn-info btn-sm","title"=>"Agregar crédito"]) }}
                                {{ link_to_route('venta.show', $title = "", $parameters = [$venta->id], $attributes = ["class"=>"btn fa fa-bars btn-primary btn-sm","title"=>"Ver detalles"]) }}
                                @can('ventas.edit')
                                    <button class="btn btn-sm btn-warning" title="Ticket Cocina"><i class="fa fa-coffee"></i></button>
                                    <button class="btn btn-sm btn-secondary" title="Ticket Cliente" onclick="ticketCompra({{ $venta->id }})"><i class="fa fa-user"></i></button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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