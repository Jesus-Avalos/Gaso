<table class="table table-striped table-bordered dt-responsive nowrap" id="generalTable" style="width:100%">
    <thead class="thead-dark">
        <tr>
            <th>Nombre</th>
            <th>Domicilio</th>
            <th>Colonia</th>
            <th>Telefono</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $cliente)
        <tr>
            <td>{{ $cliente->nombre }}</td>
            <td>{{ $cliente->domicilio }}</td>
            <td>{{ $cliente->colonia }}</td>
            <td>{{ $cliente->telefono }}</td>
        </tr>
        @endforeach
    </tbody>
</table>