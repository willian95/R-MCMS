<html>

    <head>
        <link rel="stylesheet" href="{{ public_path().'/css/bootstrap.min.css'}}" type="text/css"></link>
    </head>

    <img src="{{ public_path().'/assets/img/Logo.png'}}" alt="" style="width: 80px;">

    <div>
        <h4 class="text-center">Cupones</h4>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Marca</th>
            </tr>
        </thead>
        <tbody>
            @foreach(App\Models\Coupon::all() as $coupon)
                <tr>
                    <td>
                        {{ $loop->index + 1 }}
                    </td>
                    <td>
                        {{ $product->name }}
                    </td>
                    <td>
                        {{ $product->category->name }}
                    </td>
                    <td>
                        {{ $product->brand->name }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</html>