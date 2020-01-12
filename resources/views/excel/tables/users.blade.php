<table class="table table-striped table-bordered dt-responsive nowrap" id="generalTable" style="width:100%">
    <thead class="thead-dark">
        <tr>
            <th>Nombre</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>