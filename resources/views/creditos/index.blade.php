@extends('layouts.app')

@section('main-content')
    <div class="box box-solid box-dark">
        <div class="box-header">
            <h3 class="box-title">Clientes con deuda</h3>
        </div>

        <div class="box-body" style="padding-left: 5%; padding-right: 5%;">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="creditosTable" style="width: 100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Cliente</th>
                        <th>Deuda</th>
                        <th><i class="fa fa-wrench"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cargos as $cargo)
                        @if (count($abonos) > 0)
                            @foreach ($abonos as $abono)
                                @if ($abono->id == $cargo->id)
                                    @php
                                        $deuda = $cargo->totalCargo - $abono->totalAbono; 
                                        break;
                                    @endphp
                                @else
                                    @php
                                        $deuda = $cargo->totalCargo;
                                    @endphp
                                @endif
                            @endforeach
                        @else
                            @php
                                $deuda = $cargo->totalCargo;
                            @endphp
                        @endif
                        @if ($deuda > 0)
                            <tr>
                                <td>{{ $cargo->nombre }}</td>
                                <td>
                                    {{ $deuda }}
                                </td>
                                <td>
                                    {{ link_to_route('credito.cliente', $title = "", $parameters = [$cargo->id], $attributes = ["class"=>"btn fa fa-bars btn-primary btn-sm","title"=>"Ver detalles"]) }} 
                                </td>
                            </tr>
                        @endif
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