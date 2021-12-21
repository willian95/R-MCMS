<html>

    <head>
        <link rel="stylesheet" href="{{ public_path().'/css/bootstrap.min.css'}}" type="text/css"></link>
    </head>

    <img src="{{ public_path().'/assets/img/Logo.png'}}" alt="" style="width: 80px;">

    <div>
        <h4 class="text-center">Colores</h4>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Hex</th>
            </tr>
        </thead>
        <tbody>
            @foreach(App\Models\Color::all() as $color)
                <tr>
                    <td>
                        {{ $loop->index + 1 }}
                    </td>
                    <td>
                        {{ $color->color }}
                    </td>
                    <td>
                        {{ $color->hex }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</html>