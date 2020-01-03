<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Folio</th>
                    <th>Tipo venta</th>
                    <th>Fecha venta</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos as $dato)
                    <tr>
                        <td>{{ $dato->id }}</td>
                        <td>{{ $dato->tipo }}</td>
                        <td>{{ $dato->created_at }}</td>
                        <td>{{ $dato->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</body>
</html>