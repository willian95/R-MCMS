<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Dirección</th>
            <th>Identificación</th>
            <th>Teléfono</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
            <tr>
                <td>
                    {{ $loop->index + 1 }}
                </td>
                <td>
                    {{ $client->name }}
                </td>
                <td>
                    {{ $client->email }}
                </td>
                <td>
                    {{ $client->address }}
                </td>
                <td>
                    {{ $client->identification }}
                </td>
                <td>
                    {{ $client->phone }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>