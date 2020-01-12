<table class="table table table-striped table-bordered dt-responsive nowrap" id="generalTable">
    <thead class="thead-dark">
        <tr>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Subcategoria</th>
            <th>Stock</th>
            <th>Fecha de creación</th>
        </tr>
    </thead>
    <tbody>
        @php $cont = 0; @endphp
        @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->name }}</td>
                <td>{{ $producto->categoria }}</td>
                <td>{{ $producto->subcategoria }}</td>
                <td>{{ $stock[$cont] }}@php $cont++; @endphp</td>
                <td>{{ $producto->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>