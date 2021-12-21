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
                <th>Tipo de descuento</th>
                <th>¿Producto o total del carrito?</th>
                <th>Monto de descuento</th>
                <th>Fecha fin</th>
                <th>Código de descuento</th>
            </tr>
        </thead>
        <tbody>
            @foreach(App\Models\Coupon::all() as $coupon)
                <tr>
                    <td>
                        {{ $loop->index + 1 }}
                    </td>
                    <td>
                        {{ $coupon->discount_type }}
                    </td>
                    <td>
                        {{ $coupon->total_discount }}
                    </td>
                    <td>
                        {{ $coupon->discount_amount }}
                    </td>
                    <td>
                        {{ $coupon->end_date }}
                    </td>
                    <td>
                        {{ $coupon->coupon_code }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</html>