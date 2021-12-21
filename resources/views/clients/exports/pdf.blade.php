<html>

    <head>
        <link rel="stylesheet" href="{{ public_path().'/css/bootstrap.min.css'}}" type="text/css"></link>
    </head>

    <img src="{{ public_path().'/assets/img/Logo.png'}}" alt="" style="width: 80px;">

    <div>
        <h4 class="text-center">Clientes</h4>
    </div>

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
            @foreach(App\Models\User::where("role_id", 2)->get() as $user)
                <tr>
                    <td>
                        {{ $loop->index + 1 }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->address }}
                    </td>
                    <td>
                        {{ $user->identification }}
                    </td>
                    <td>
                        {{ $user->phone }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</html>