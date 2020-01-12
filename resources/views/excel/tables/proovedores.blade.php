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
        @foreach($proovedores as $proovedor)
            <tr>
                <td>{{ $proovedor->nombre }}</td>
                <td>{{ $proovedor->domicilio }}</td>
                <td>{{ $proovedor->colonia }}</td>
                <td>{{ $proovedor->telefono }}</td>
            </tr>
        @endforeach
    </tbody>
</table>