<table class="table table-striped table-bordered dt-responsive nowrap" id="generalTable" style="width: 100%">
    <thead class="thead-dark">
        <tr>
            <th>Folio</th>
            <th>Cliente</th>
            <th>Tipo</th>
            <th>Mesa</th>
            <th>Tipo pago</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ventas as $venta)
            <?php $tipo = ($venta->status == 'Exitosa') ? 'success' : 'danger' ?>
            <tr>
                <td> {{$venta->id}} </td>
                <td>{{ $venta->cliente }}</td>
                <td>{{$venta->tipo}}</td>
                <td>{{ ($venta->mesa != '') ? $venta->mesa : 'No aplica' }}</td>
                <td>{{$venta->tipoPago}}</td>
                <td>$ {{$venta->total}}</td>
                <td><small class="label label-{{$tipo}}">{{$venta->status}}</small></td>
            </tr>
        @endforeach
    </tbody>
</table>