<table class="table table table-striped table-bordered dt-responsive nowrap" id="generalTable">
    <thead class="thead-dark">
        <tr>
            <th>NOMBRE</th>
            <th>TIPO</th>
            <th>CANTIDAD</th>
            <th>$/UNIDAD</th>
            <th>PORCIONES</th>
            <th>STOCK MINIMO</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articulos as $articulo)
            <tr>
                <td>{{ $articulo->nombre }}</td>
                <td>{{ $articulo->tipo }}</td>
                <td class="text-center">{{ $articulo->cantidad }}</td>
                <td class="text-center">{{ $articulo->precio_unidad }}</td>
                <td class="text-center">{{ $articulo->porciones }}</td>
                <td class="text-center">{{ $articulo->stock_min }}</td>
            </tr>
        @endforeach
    </tbody>
</table>